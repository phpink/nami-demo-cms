FROM php:5.6.14-fpm

# Users config
ENV DOCKER_USER=developer \
    DOCKER_USER_PASSWORD=password \
    DOCKER_GROUP=www-data \
    UID=1001 \
    GID=1001 \
    SOURCE_ROOT=/var/www

# Install tools
RUN apt-get update \
    && apt-get upgrade -y\
    && apt-get install apt-utils curl wget debconf-utils locales -y

ENV PHP_EXTRA_CONFIGURE_ARGS --enable-fpm --with-fpm-user={$DOCKER_USER} --with-fpm-group={$DOCKER_GROUP}

# Add php library
RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        libbz2-dev \
        libicu-dev \
        libxslt1-dev \
        libpq-dev \
        libzmq3-dev \
        g++ \
        libldap2-dev \
    &&  docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install xsl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install opcache

ENV TERM=xterm

#Install vi nano...
RUN apt-get install git build-essential tmux vim nano sudo -y \
    && apt-get clean \

# Install Composer globaly
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \

# xdebug
    && pecl install xdebug


RUN sed -i '/fr_FR.UTF-8 UTF-8/s/^# //g' /etc/locale.gen \
    && locale-gen --purge fr_FR.utf8
    #&& echo '${LANG:=fr_FR.utf8}; export LANG' >> /etc/profile
ENV LANG=fr_FR.utf8

RUN echo 'date.timezone = Europe/Paris' > /usr/local/etc/php/conf.d/date.ini \
    && echo "Europe/Paris" > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

#Set conf files
ADD ./php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf
ADD ./php-fpm/php.ini /usr/local/etc/php/
ADD ./php-fpm/xdebug.ini /usr/local/etc/php/conf.d/

ADD ./php-fpm/run.sh /home/run.sh

RUN chmod +x /home/run.sh
WORKDIR /var/www/

CMD ["/home/run.sh"]


EXPOSE 80 443

CMD ["php-fpm"]
