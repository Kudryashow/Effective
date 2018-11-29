reinit: restart remake
		make restart
		make remake
restart:
		cp ~/.ssh/id_rsa.pub ~/tasks/task2/sync
		vagrant halt
		vagrant up
		vagrant ssh
remake:
		vagrant destroy -f
		vagrant up --provision