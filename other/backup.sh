#!/usr/bin/env bash
#executable script for cron path: ~/backup.sh

tar -cvpzf backup.tar.gz /etc
scp ~/backup.tar.gz vagrant@192.168.83.20:~/backup.tar.gz
