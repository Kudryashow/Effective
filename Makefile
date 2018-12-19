reinit: restart remake
		make restart
		make remake
refresh:
		vagrant halt
		vagrant up
		vagrant ssh
rmk:
		vagrant destroy
        vagrant up
        vagrant ssh
        sudo yum update -y && sudo yum install -y kernel kernel-devel
        exit
        vagrant reload —provision