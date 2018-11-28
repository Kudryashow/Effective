#!/bin/bash

yum update -y
yum install -y epel-release yum-utils
yum install -y nginx
yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
yum-config-manager --enable remi-php71
yum install -y php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysqlsudo cp sync/project.local /etc/nginx/sites-available/project.local
cp /www/vhosts/sync/sync/project.local.conf /etc/nginx/conf.d/project.local.conf
yum install -y php-fpm
sudo systemctl enable nginx
sudo systemctl start nginx