#!/bin/sh
setfacl -R -m u:apache:rwx cakephp/app/tmp
setfacl -R -m u:${USER}:rwx cakephp/app/tmp
setfacl -R -d -m u:apache:rwx cakephp/app/tmp
setfacl -R -d -m u:${USER}:rwx cakephp/app/tmp