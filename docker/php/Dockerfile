FROM php:8.3-apache

# Install required system packages and dependencies
RUN apt-get update && apt-get install -y \
    libgmp-dev \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt install -y git
RUN apt-get update && apt install -y unzip

RUN pecl install excimer

# Compile and install the GMP extension
RUN docker-php-ext-configure gmp \
    && docker-php-ext-install gmp

RUN curl -SLO https://deb.nodesource.com/nsolid_setup_deb.sh \
    && chmod 500 nsolid_setup_deb.sh \
    && ./nsolid_setup_deb.sh 21 \
    && apt-get install nodejs -y \
    && rm nsolid_setup_deb.sh

# Composer
RUN curl -o composer-installer --silent --show-error https://getcomposer.org/installer \
    && php composer-installer --install-dir=/usr/bin --filename=composer \
    && rm composer-installer

# Configure xdebug
#RUN pecl install xdebug \
#        && docker-php-ext-enable xdebug \
#        && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#        && echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#        && echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#        && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#        && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#        && echo 'xdebug.client_host=host.docker.internal' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#        && echo 'xdebug.idekey=xdebug' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


# Set document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public/
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && sed -ri -e "s!/var/www!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable apache extensions
RUN a2enmod rewrite \
    && a2enmod headers

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

# Copy SSL certificate and private key - comment this section if you want to run on localhost
COPY /ssl/educrypter.uhk.cz.cert /etc/apache2/ssl/educrypter.uhk.cz.cert
COPY /ssl/educrypter.uhk.cz.key /etc/apache2/ssl/educrypter.uhk.cz.key
RUN a2enmod ssl
# Enable SSL site
COPY ./conf/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
RUN a2ensite default-ssl.conf

RUN chmod 600 /etc/apache2/ssl/educrypter.uhk.cz.key

# Expose ports
EXPOSE 80

# comment this if you want localhost
EXPOSE 443


