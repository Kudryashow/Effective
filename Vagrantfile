require 'yaml'

Vagrant.configure('2') do |config|

  config.vm.box = config.vm.box = "generic/centos7"
  set = YAML.load_file('config/vagrant-local.yml')

  config.vm.provider "virtualbox" do |v|
    v.memory = set['server']['ram']
    v.cpus = set['server']['cpus']
    v.name = set['server']['name']
  end

  config.vm.synced_folder "app", "/home/vagrant/projects/project.local", owner: 'vagrant', group: 'vagrant', mount_options: ["dmode=777", "fmode=777"]
  config.vm.synced_folder "config", "/home/vagrant/project.local", owner: 'vagrant', group: 'vagrant'

  config.vm.network "private_network", ip: set['server']['ip']
  config.vm.network 'public_network', bridge: set['server']['bridge_interface']

  config.vm.provision "shell", path: "provision/once-as-root.sh"
end