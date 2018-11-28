#!/bin/bash

sudo yum update
sudo yum install -y nginx
sudo yum install -y epel-release yum-utils
sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum-config-manager --enable remi-php71
sudo yum install -y php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysqlsudo cp sync/project.local /etc/nginx/sites-available/project.local
cd /www/vhosts/sync/
sudo cp project.local.conf /etc/nginx/conf.d/project.local.conf
cd /etc/nginx/conf.d
sudo yum install -y php-fpm
sudo systemctl start nginx