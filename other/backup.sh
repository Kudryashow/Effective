!#/bin/bash

sudo tar czf /backup.tar.gz --exclude=/backup.tar.gz --exclude=/home --exclude=/media --exclude=/dev --exclude=/mnt --exclude=/proc --exclude=/sys --exclude=/tmp --exclude=/usr --exclude=/var /
cp /backup.tar.gz /tasks/task2/sync