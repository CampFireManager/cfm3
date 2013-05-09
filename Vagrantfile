Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu"
  config.vm.box_url = "https://s3.amazonaws.com/gsc-vagrant-boxes/ubuntu-12.04.2-i386-chef-11-omnibus.box"

  config.ssh.timeout = 300
  config.ssh.max_tries = 300

  # This works around errors during `vagrant up` about missing host name
  config.vm.hostname = "cfm3.local"

  # This subnet (192.0.2.0/24) is designated as being for TEST-NET-1 in RFC5737
  # which seems appropriate. It should not appear on any private IPv4 networks,
  # however, it is really supposed to be used for documentation and example
  # code. This would, presumably, be changed when deploying to live.
  config.vm.network :private_network, ip: "192.0.2.100"

  # If you have a static public IP address, comment out the above line, and 
  # use the next one (prefixed ## instead of just #) instead (obviously, 
  # changing 1.2.3.4 to your real IP address)
  #
  # Alternatively, if you have DHCP on your network, remove `, ip: "1.2.3.4"`
  # to make it do a DHCP request.
  #
  ## config.vm.network :public_network, ip: "1.2.3.4"
  
  # On my system, the DNS isn't being picked up. This switch exposes the host's 
  # locally configured DNS server to the guest via NAT.
  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "manifests"
    puppet.manifest_file = "default.pp"
    # This means we could set various actions on puppet based on the production 
    # status. Initially just "Development", "Production"
    puppet.facter => { 
      "ProductionStatus" => "Development" 
    }
  end

  config.vm.synced_folder "./", "/var/www"
end
