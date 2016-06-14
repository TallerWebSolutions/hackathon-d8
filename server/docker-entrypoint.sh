#!/bin/bash

sudo service nginx stop
sudo service php5-fpm stop

sudo service php5-fpm start
sudo service nginx start

sudo chown $UID:$UID -R /drupal/src

while ! nc -q 1 drupal-db 3306 </dev/null; do sleep 3; done

if [ ! -f /drupal/src/docroot/sites/default/settings.local.php ]
then
  cp /drupal/server/settings.local.php /drupal/src/docroot/sites/default/settings.local.php
  sudo chmod 777 -Rf /drupal/src/docroot/sites/default/settings.local.php

  mkdir -p /drupal/src/docroot/sites/default/files

  sudo chmod 777 /drupal/src/docroot/sites/default/files
  cd /drupal/src/docroot && composer install
fi

echo "Máquina pronta para Trabalhar"

exec "$@"
