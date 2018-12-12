reinit: restart remake
		make restart
		make remake
refresh:
		vagrant halt
		vagrant up
		vagrant ssh
remake:
		vagrant destroy -f
		vagrant up --provision