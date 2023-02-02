#!/bin/sh
echo '----------------------------------------'
echo "$0 - Composer installation"
echo '----------------------------------------'
composer -v > /dev/null 2>&1
if [ $? -ne 0 ]; then
  EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

  if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]
  then
      >&2 echo 'ERROR: Invalid installer checksum'
      rm composer-setup.php
      exit 1
  fi

  echo 'Downloading composer.phar'
  php composer-setup.php --quiet
  # php composer-setup.php --quiet
  echo 'sudo mv composer.phar /usr/local/bin/composer'
  sudo mv composer.phar /usr/local/bin/composer
  RESULT=$?
  rm composer-setup.php
else
  echo 'Composer already installed'
  RESULT=$?
fi

if [ $RESULT -ne 0 ]; then
  echo "Error during the installation"
  exit $RESULT
fi
echo '----------------------------------------'
echo "$0 - Dependencies installation"
echo '----------------------------------------'
composer install

