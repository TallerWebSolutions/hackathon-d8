FROM nginx:latest

ENV DEBIAN_FRONTEND noninteractive

RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

### UPDATE DEBIAN
RUN apt-get update -y && apt-get upgrade -y && apt-get dist-upgrade -y && apt-get autoremove -y

### INSTALL PHP-FPM AND EXTENSION
RUN apt-get update -y && apt-get install -y \
    php5-fpm \
    php5-curl \
    php5-gd \
    php5-geoip \
    php5-imagick \
    php5-imap \
    php5-json \
    php5-ldap \
    php5-mcrypt \
    php5-memcache \
    php5-memcached \
    php5-mongo \
    php5-mysqlnd \
    php5-redis \
    php5-sqlite \
    php5-xdebug \
    php5-xmlrpc \
    php5-xcache \
		sudo \
		htop \
		curl \
		git \
		libpng12-dev \
		libjpeg-dev \
		libpq-dev \
    vim \
    imagemagick \
    mysql-client \
    bash-completion \
    libfontconfig1 \
    bzip2 \
    build-essential \
    python-software-properties \
    locales

### CONFIGURE LOCALES
RUN echo "LANGUAGE=pt_BR.UTF-8" >> /etc/environment
RUN echo "LANG=pt_BR.UTF-8"     >> /etc/environment
RUN echo "LC_ALL=pt_BR.UTF-8"   >> /etc/environment
RUN locale-gen pt_BR.UTF-8
RUN dpkg-reconfigure locales

### INSTALL COMPOSER
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_DISABLE_XDEBUG_WARN 1
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer self-update

# Download latest stable release using the code below or browse to github.com/drush-ops/drush/releases.
RUN curl http://files.drush.org/drush.phar > drush.phar

# Rename to `drush` instead of `php drush.phar`. Destination can be anywhere on $PATH.
RUN chmod +x drush.phar
RUN mv drush.phar /usr/local/bin/drush

### CREATE USER FOR DEVELOPMENT
RUN echo "%sudo ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers && \
    useradd -u 1000 -G users,www-data,sudo -d /drupal --shell /bin/bash -m drupal && \
    echo "secret\nsecret" | passwd drupal

RUN apt-get install netcat --yes

RUN apt-get install openconnect --yes
RUN apt-get install wget --yes
RUN wget https://phar.phpunit.de/phpunit.phar
RUN chmod +x phpunit.phar
RUN mv phpunit.phar /usr/local/bin/phpunit

### CONFIGURE PHP-FPM
RUN echo "xdebug.max_nesting_level=9999" >> /etc/php5/mods-available/xdebug.ini
RUN sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php5/fpm/php.ini && \
    sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php5/fpm/php.ini && \
    sed -i "s/display_errors = Off/display_errors = stderr/" /etc/php5/fpm/php.ini && \
    sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 30M/" /etc/php5/fpm/php.ini && \
    sed -i "s/;opcache.enable=0/opcache.enable=1/" /etc/php5/fpm/php.ini && \
    sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php5/fpm/php-fpm.conf && \
    sed -i '/^listen = /clisten = 9000' /etc/php5/fpm/pool.d/www.conf && \
    sed -i '/^listen.allowed_clients/c;listen.allowed_clients =' /etc/php5/fpm/pool.d/www.conf && \
    sed -i '/^;catch_workers_output/ccatch_workers_output = yes' /etc/php5/fpm/pool.d/www.conf && \
    sed -i '/^;env\[TEMP\] = .*/aenv[DB_PORT_3306_TCP_ADDR] = $DB_PORT_3306_TCP_ADDR' /etc/php5/fpm/pool.d/www.conf

### APPLY NGINX CONFIGURATION
RUN mkdir -p /tmp/logs
RUN chmod 777 /tmp/logs
COPY ./server/nginx.conf /etc/nginx/nginx.conf
COPY ./server/fastcgi.conf /etc/nginx/fastcgi.conf
COPY ./server/bash.bashrc /etc/bash.bashrc

### APPLY ENTRYPOINT
COPY ./server/docker-entrypoint.sh /drupal/docker-entrypoint.sh
RUN chmod +x /drupal/docker-entrypoint.sh

USER drupal
WORKDIR /drupal

CMD [ "bash" ]
ENTRYPOINT ["/drupal/docker-entrypoint.sh"]
