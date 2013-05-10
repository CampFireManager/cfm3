$extlookup_datadir = "./extdata"
$extlookup_precedence = ["%{fqdn}", "default"]

class timezone {
    $timezone_region = extlookup('timezone')

    file { "/etc/timezone":
        content => "${timezone_region}\n",
    }

    exec { "timezonesetup":
        command => "dpkg-reconfigure -f noninteractive tzdata",
        require => File["/etc/timezone"]
    }
}

class mysql {
    $username = extlookup('mysql_user')
    $password = extlookup('mysql_pass')
    $database = extlookup('mysql_base')

    package { "mysql-server": 
        ensure => "installed" 
    }

    service { "mysql":
        enable => true,
        ensure => running,
        require => Package["mysql-server"],
    }

    # This part is based on 
    # http://bitfieldconsulting.com/puppet-and-mysql-create-databases-and-users

    exec { "create db":
        unless => "mysql -uroot ${database}",
        command => "echo 'create database ${database}' | mysql -uroot",
        require => Service["mysql"]
    }    

    exec { "grant rights":
        unless => "/usr/bin/mysql -u${username} -p\"${password}\" ${database}",
        command => "/usr/bin/mysql -uroot -e \"grant all on ${database}.* to ${username}@localhost identified by '${password}';\"",
        require => [Service["mysql"], Exec["create db"]]
    }

    # todo: If username is not as per default, touch config/autoload/local.php
    # and set the db credentials in there!
}

class apache_and_php {
    $ssl_file_base = extlookup('ssl_file_base')

    $packages = [
        "curl",
        "apache2",
        "php5", 
        "php5-dev",
        "php5-cli",
        "php5-mysql",
        "libapache2-mod-php5",
        "php-pear",
        "php5-mcrypt",
        "php5-curl",
        "php-apc",
        "imagemagick",
        "php5-imagick",
        "git"
    ]

    package { $packages:
        ensure => "installed",
        require => Exec["git ppa"]
    }

    exec { "apt-get upgrade":
        command => "sudo apt-get update && sudo apt-get upgrade -y",
        require => Package["php5"]
    }

    exec { "enable ssl":
        command => "sudo a2enmod ssl",
        require => Package["apache2"]
    }

    exec { "add ssl port":
        command => "echo 'NameVirtualHost *:443' >> /etc/apache2/ports.conf",
        require => Exec["enable ssl"]
    }

    file { "/etc/apache2/ssl":
        ensure => directory,
        require => Exec["add ssl port"]
    }

    file { "/etc/apache2/ssl/apache.key":
        source => "/tmp/vagrant-puppet/manifests/resources/ssl/${ssl_file_base}.key",
        require => File["/etc/apache2/ssl"]
    }

    file { "/etc/apache2/ssl/apache.pem":
        source => "/tmp/vagrant-puppet/manifests/resources/ssl/${ssl_file_base}.pem",
        require => File["/etc/apache2/ssl"]
    }
    
    file { "/etc/apache2/sites-available/default":
        source => "/tmp/vagrant-puppet/manifests/resources/cfm3.conf",
        require => Package["apache2"]
    }

    exec { "enable rewrite":
        command => "sudo a2enmod rewrite",
        require => Package["apache2"]
    }

    exec { "enable site":
        command => "sudo a2ensite default",
        require => File["/etc/apache2/sites-available/default"]
    }

    exec { "restart apache":
        command => "sudo service apache2 reload",
        require => Exec["enable site"]
    }
}

class composer {
    exec { "install composer executable":
        onlyif => "[ ! -f /usr/local/bin/composer ]",
        command => "curl -sS https://getcomposer.org/installer | php && sudo mv composer.phar /usr/local/bin/composer",
        require => [Package["php5-cli"], Package["curl"]],
        creates => "/usr/local/bin/composer"
    }

    exec { "upgrade composer":
        onlyif => "[ -f /usr/local/bin/composer ]",
        command => "composer self-update",
        require => Package["php5-cli"]
    }

    exec { "install composer spec":
        cwd => "/var/www",
        environment => "HOME=/home/${id}",
        command => "composer install",
        require => [Exec["install composer executable"], Exec["upgrade composer"]]
    }
}

node default {
    include timezone

    Exec {
        path => '/usr/local/bin:/bin:/usr/bin:/home/vagrant/bin:/usr/sbin:/sbin'
    }

    exec { "apt-get update":
        command => "apt-get update",
    }

    Package { require => Exec["apt-get update"] }
    File { require => Exec["apt-get update"] }

    package { "python-software-properties":
        ensure => present,
    }

    exec { "php54 ppa":
        command => "sudo add-apt-repository ppa:ondrej/php5 --yes",
        require => Package["python-software-properties"]
    }

    exec { "git ppa":
        command => "sudo add-apt-repository ppa:git-core/ppa --yes",
        require => Exec["php54 ppa"]
    }

    include mysql
    include apache_and_php
    include composer
}
