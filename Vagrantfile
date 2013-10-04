# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
	
	config.vm.box = "ubuntu-raring"
	config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/raring/current/raring-server-cloudimg-i386-vagrant-disk1.box"
	
	config.vm.network :forwarded_port, guest: 80, host: 8080
	
	config.vm.provision :puppet do |puppet|
		puppet.manifests_path = "vagrant"
		puppet.manifest_file = "puppet_manifest.pp"
	end
	
end
