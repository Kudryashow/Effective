#!/usr/bin/env bash

sudo tar -cvpzf backup.tar.gz /etc
scp ~/backup.tar.gz vagrant@192.168.83.20:~/backup.tar.gz