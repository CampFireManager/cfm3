Vagrant::Config.run do |config|
  config.vm.box = "ubuntu"
  config.vm.box_url = "https://s3.amazonaws.com/gsc-vagrant-boxes/ubuntu-12.04.2-i386-chef-11-omnibus.box"

  config.ssh.timeout = 300
  config.ssh.max_tries = 300

  config.vm.network :hostonly, "33.33.33.101"

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "manifests"
    puppet.manifest_file = "default.pp"
  end

  config.vm.share_folder "www", "/var/www", "./"

end
