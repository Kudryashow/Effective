#!/bin/bash
info "Setting reps + update yum"
yum update -y
yum install -y epel-release yum-utils
yum install -y nginx
info  "Install repositories"
yum install -y wget > /dev/null
wget -q https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
wget -q http://rpms.remirepo.net/enterprise/remi-release-7.rpm
rpm -Uvh remi-release-7.rpm epel-release-latest-7.noarch.rpm
yum install yum-utils  > /dev/null
yum-config-manager --enable remi-php71 > /dev/null
info "Install php"
yum install -y php php-mbstring php-bcmath php-mysqlnd php-pecl-imagick php-zip php-memcached php-soap php-opcache php-pecl-xdebug php-pecl-amqp php-dom php-fpm php-process php-pdo-dblib php-gd > /dev/null
systemctl enable php-fpm
info "Configure php"
sed -i 's/user = apache/user = vagrant/g' /etc/php-fpm.d/www.conf
sed -i 's/group = apache/group = vagrant/g' /etc/php-fpm.d/www.conf
cp /home/vagrant/project.local/vagrant/etc/php.d/* /etc/php.d/
cp /home/vagrant/project.local/vagrant/etc/php.ini /etc/
echo "Done!"
info "Configure nginx ....."
cp /home/vagrant/project.local/project.local.conf /etc/nginx/conf.d/project.local.conf
mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.backup
cp /home/vagrant/project.local/nginx.conf /etc/nginx/nginx.conf
info "Configure php-fpm ....."
mv /etc/php-fpm.d/www.conf /etc/php-fpm.d/www.conf.backup
cp /home/vagrant/project.local/www.conf /etc/php-fpm.d/www.conf
info "Run both and privileging ....."
systemctl enable php-fpm nginx
systemctl start php-fpm nginx
chmod 777 /var/run/php-fpm/php-fpm.sock
info "Host enabling ....."
mv /etc/hosts /etc/hosts.backup
cp /home/vagrant/project.local/hosts.txt /etc/hosts
systemctl restart php-fpm
sudo setenforce 0
