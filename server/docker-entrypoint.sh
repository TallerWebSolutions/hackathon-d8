#!/bin/bash

sudo service nginx stop
sudo service php5-fpm stop

sudo service php5-fpm start
sudo service nginx start

sudo chown $UID:$UID -R /drupal/src

while ! nc -q 1 drupal-db 3306 </dev/null; do sleep 3; done

if [ ! -f /drupal/src/docroot/sites/default/settings.php ]
then
  cp /drupal/src/docroot/sites/default/default.settings.php /drupal/src/docroot/sites/default/settings.php
  sudo chmod 777 -Rf /drupal/src/docroot/sites/default/settings.php

  mkdir -p /drupal/src/docroot/sites/default/files

  sudo chmod 777 /drupal/src/docroot/sites/default/files
  cd /drupal/src/docroot && composer install
fi

echo "Máquina pronta para Trabalhar"

exec "$@"
