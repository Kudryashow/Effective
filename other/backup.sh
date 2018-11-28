!#/bin/bash

if [-n $1]
then 
to=$1
else to='/home/user'
fi

sudo tar czf /backup.tar.gz --exclude=/backup.tar.gz --exclude=/home --exclude=/media --exclude=/dev --exclude=/mnt --exclude=/proc --exclude=/sys --exclude=/tmp --exclude=/usr --exclude=/var /
scp /backup.tar.gz to
