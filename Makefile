restart:
		vagrant halt
		vagrant up
remake:
		vagrant destroy -y
		vagrant up --provision