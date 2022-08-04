if ! test -d ./storage; then
  mkdir ./storage
else
  echo 'skip storage'
fi

if ! test -d ./storage/logs; then
  mkdir ./storage/logs
else
  echo 'skip storage/logs'
fi
if ! test -d ./storage/framework; then
  mkdir ./storage/framework
  mkdir ./storage/framework/cache && ./storage/framework/cache/data
  mkdir ./storage/framework/sessions
  mkdir ./storage/framework/testing
  mkdir ./storage/framework/views
else
  echo 'skip storage/framework'
fi

# chgrp -R www-data ./storage
# chown -R www-data ./storage

# permission
sudo chmod o+w ./storage/ -R

ls -la ./storage/logs
