#!/bin/sh
mkdir -p cakephp/app/config
mkdir -p cakephp/app/tmp/cache
mkdir -p cakephp/app/tmp/cache/models
mkdir -p cakephp/app/tmp/cache/persistent
mkdir -p cakephp/app/tmp/logs
mkdir -p cakephp/app/cal_tmp
setfacl -R -m u:apache:rwx cakephp/app/tmp
setfacl -R -m u:${USER}:rwx cakephp/app/tmp
setfacl -R -d -m u:apache:rwx cakephp/app/tmp
setfacl -R -d -m u:${USER}:rwx cakephp/app/tmp
setfacl -R -d -m u:apache:rwx cakephp/app/cal_tmp                                                                                    
setfacl -R -d -m u:${USER}:rwx cakephp/app/cal_tmp

