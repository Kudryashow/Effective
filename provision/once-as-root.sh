#!/bin/bash

sudo yum update -y
sudo yum install -y epel-release yum-utils
sudo yum install -y nginx
sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum-config-manager --enable remi-php71
sudo yum install -y php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysqlsudo cp sync/project.local /etc/nginx/sites-available/project.local
sudo cp /home/vagrant/project.local/www.conf /etc/nginx/conf.d/project.local.conf
sudo yum install -y php-fpm
sudo systemctl enable nginx
sudo chcon -R -t httpd_sys_content_t /www/vhosts/project.local
sudo mv /etc/php-fpm.d/www.conf /etc/php-fpm.d/www.conf.backup
sudo cp /home/vagrant/project.local/www.conf /etc/php-fpm.d/www.conf
sudo chmod 777 /etc/php-fpm.d/www.conf
sudo mv /etc/hosts /etc/hosts.backup
sudo cp /home/vagrant/project.local/hosts.txt /etc/hosts
sudo systemctl start nginx
sudo wget http://repo.mysql.com/mysql57-community-release-el7.rpm
sudo rpm -ivh mysql57-community-release-el7.rpm
sudo yum update
sudo yum install mysql-server
sudo systemctl start mysqld
sudo mysql_secure_installation
sduo grep 'temporary password' /var/log/mysqld.log
