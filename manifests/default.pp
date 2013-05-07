node default {
    Exec {
        path => '/usr/local/bin:/bin:/usr/bin:/home/vagrant/bin:/usr/sbin:/sbin'
    }

    file { "/etc/timezone":
        content => "Europe/London\n",
    }

    exec { "timezonesetup":
        command => "dpkg-reconfigure -f noninteractive tzdata",
        require => File["/etc/timezone"]
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


    exec { "apt-get update":
        command => "apt-get update",
    }


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
        "mysql-server",
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

    exec { "add ssl dir":
        command => "mkdir /etc/apache2/ssl",
        require => Exec["add ssl port"]
    }

    file { "/etc/apache2/ssl/apache.key":
        source => "/tmp/vagrant-puppet/manifests/resources/ssl/apache.key",
        require => Exec["add ssl dir"]
    }

    file { "/etc/apache2/ssl/apache.pem":
        source => "/tmp/vagrant-puppet/manifests/resources/ssl/apache.pem",
        require => Exec["add ssl dir"]
    }

    service { "mysql":
        enable => true,
        ensure => running,
        require => Package["mysql-server"],
    }

    exec { "create db":
        command => "echo 'create database cfm3' | mysql -uroot",
        require => Service["mysql"]
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
