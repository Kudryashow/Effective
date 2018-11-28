reinit: restart remake
		make restart
		make remake
restart:
		vagrant halt
		vagrant up
remake:
		vagrant destroy -f
		vagrant up --provision