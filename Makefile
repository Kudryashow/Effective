reinit: restart remake
		make restart
		make remake
refresh:
		vagrant halt
		vagrant up
		vagrant ssh
rmk:
		vagrant destroy -f
		vagrant up
		vagrant halt
		vagrant up
		vagrant ssh