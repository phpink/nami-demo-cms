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
        g++ \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install xsl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install opcache \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql

ENV TERM=xterm

#Install vi nano... // TODO: add git find a solution
RUN apt-get install build-essential tmux vim nano sudo -y \
    && apt-get clean

# Install Composer globaly
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# xdebug
 RUN pecl install xdebug redis mongo


RUN sed -i '/fr_FR.UTF-8 UTF-8/s/^# //g' /etc/locale.gen \
    && locale-gen --purge fr_FR.utf8
    #&& echo '${LANG:=fr_FR.utf8}; export LANG' >> /etc/profile
ENV LANG=fr_FR.utf8

RUN echo 'date.timezone = Europe/Paris' > /usr/local/etc/php/conf.d/date.ini \
    && echo "Europe/Paris" > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

#Set conf files
ADD ./php-fpm.conf /usr/local/etc/php-fpm.conf
ADD ./php.ini /usr/local/etc/php/
ADD ./xdebug.ini /usr/local/etc/php/conf.d/
RUN echo extension=redis.so >> /usr/local/etc/php/conf.d/redis.ini
RUN echo extension=mongo.so >> /usr/local/etc/php/conf.d/mongo.ini

ADD ./run.sh /home/run.sh

RUN chmod +x /home/run.sh
WORKDIR /var/www/

CMD ["/home/run.sh"]
