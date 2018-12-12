#!/bin/bash
info "Setting reps + update yum"
sudo yum update -y
sudo yum install -y epel-release yum-utils
sudo yum install -y nginx
info "DONE !"
info "Install php ....."
sudo rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum -y install yum-utils
sudo yum update -y
sudo yum -y install php
sudo yum-config-manager --enable remi-php71
sudo yum install -y php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysqlsudo cp sync/project.local /etc/nginx/sites-available/project.local
info "DONE !"
info "Configure nginx ....."
sudo cp /home/vagrant/project.local/project.local.conf /etc/nginx/conf.d/project.local.conf
sudo mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.backup
sudo cp /home/vagrant/project.local/nginx.conf /etc/nginx/nginx.conf
info "DONE !"
info "Configure php-fpm ....."
sudo yum install -y php-fpm
sudo mv /etc/php-fpm.d/www.conf /etc/php-fpm.d/www.conf.backup
sudo cp /home/vagrant/project.local/www.conf /etc/php-fpm.d/www.conf
info "DONE !"
info "Run both and privileging ....."
sudo systemctl enable php-fpm nginx
sudo systemctl start php-fpm nginx
sudo chmod 777 /var/run/php-fpm/php-fpm.sock
info "DONE !"
info "Host enabling ....."
sudo mv /etc/hosts /etc/hosts.backup
sudo cp /home/vagrant/project.local/hosts.txt /etc/hosts
info "DONE !"
info "MySQL installing ....."
sudo wget http://repo.mysql.com/mysql57-community-release-el7.rpm
sudo rpm -ivh mysql57-community-release-el7.rpm
sudo yum update -y
sudo yum install mysql-server -y
sudo systemctl start mysqld
sudo mysql_secure_installation
sudo cat /var/log/www.access.log
sudo yum install wget -y
wget -O ~/xdebug-2.4.0.tgz http://xdebug.org/files/xdebug-2.4.0.tgz
tar -xvzf ~/xdebug-2.4.0.tgz
cd ~/xdebug-2.4.0
sudo yum install -y php-devel
phpize
./configure
make
sudo cp modules/xdebug.so /usr/lib64/php/modules/xdebug.so
cd
sudo mv /etc/php.ini /etc/php.ini.backup
sudo cp /home/vagrant/project.local/php.ini.back /etc/php.ini
sudo systemctl restart nginx php-fpm
sudo setenforce 0
