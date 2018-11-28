#!/bin/bash

yum update
yum install -y nginx
yum install -y epel-release yum-utils
yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
yum-config-manager --enable remi-php71
yum install -y php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysqlsudo cp sync/project.local /etc/nginx/sites-available/project.local
cd /www/vhosts/sync/config
cp project.local.conf /etc/nginx/conf.d/project.local.conf
cd /etc/nginx/conf.d
yum install -y php-fpm
systemctl enable nginx