#!/bin/bash
if ! test -d ./storage; then
  mkdir ./storage
fi

if ! test -d ./storage/logs; then
  mkdir ./storage/logs
fi
if ! test -d ./storage/framework; then
  mkdir ./storage/framework
  mkdir ./storage/framework/cache
  mkdir ./storage/framework/cache/data
  mkdir ./storage/framework/sessions
  mkdir ./storage/framework/testing
  mkdir ./storage/framework/views
fi

# chgrp -R www-data ./storage
# chown -R www-data ./storage

# permission
sudo chmod o+w ./storage/ -R

#ls -la ./storage/logs
