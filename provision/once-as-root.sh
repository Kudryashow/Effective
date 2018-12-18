#!/bin/bash
info "Setting reps + update yum"
yum update -y
yum install -y epel-release yum-utils
yum install -y nginx
info "Install php ....."
rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
yum -y install yum-utils
yum update -y
yum -y install php
yum-config-manager --enable remi-php71
yum install -y php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysql
cp sync/project.local /etc/nginx/sites-available/project.local
info "Configure nginx ....."
cp /home/vagrant/project.local/project.local.conf /etc/nginx/conf.d/project.local.conf
mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.backup
cp /home/vagrant/project.local/nginx.conf /etc/nginx/nginx.conf
info "Configure php-fpm ....."
yum install -y php-fpm
mv /etc/php-fpm.d/www.conf /etc/php-fpm.d/www.conf.backup
cp /home/vagrant/project.local/www.conf /etc/php-fpm.d/www.conf
info "Run both and privileging ....."
systemctl enable php-fpm nginx
systemctl start php-fpm nginx
chmod 777 /var/run/php-fpm/php-fpm.sock
info "Host enabling ....."
mv /etc/hosts /etc/hosts.backup
cp /home/vagrant/project.local/hosts.txt /etc/hosts
#info "MySQL installing ....."
#sudo yum install wget -y
#sudo wget http://repo.mysql.com/mysql57-community-release-el7.rpm
#sudo rpm -ivh mysql57-community-release-el7.rpm
#sudo yum update -y
#sudo yum install mysql-server -y
#sudo systemctl start mysqld
#sudo mv /etc/my.cnf /etc/my.cnf.backup
#sudo cp /home/vagrant/project.local/my.cnf /etc/my.cnf
#yum install php-pdo -y
#yum install php-pdo_mysql -y

info "Configure php"
sed -i 's/user = apache/user = vagrant/g' /etc/php-fpm.d/www.conf
sed -i 's/group = apache/group = vagrant/g' /etc/php-fpm.d/www.conf
cp /home/vagrant/project.local/vagrant/etc/php.d/* /etc/php.d/
cp /home/vagrant/project.local/vagrant/etc/php.ini /etc/
echo "Done!"
yum install xdebug -y
systemctl restart php-fpm
sudo setenforce 0

#grep 'temporary password' /var/log/mysqld.log

#CREATE USER 'vagrant'@'localhost' IDENTIFIED BY 'qwerty';
#GRANT ALL PRIVILEGES ON * . * TO 'vagrant'@'localhost';
#CREATE USER 'vagrant'@'localhost' IDENTIFIED BY 'qwerty';
#GRANT ALL PRIVILEGES ON *.* TO vagrant@'%' IDENTIFIED BY 'qwerty';
# FLUSH PRIVILEGES;

#sudo mysql_secure_installation
