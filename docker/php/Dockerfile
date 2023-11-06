FROM php:8.2.12-apache
RUN curl -SLO https://deb.nodesource.com/nsolid_setup_deb.sh \
    && chmod 500 nsolid_setup_deb.sh \
    && ./nsolid_setup_deb.sh 21 \
    && apt-get install nodejs -y \
    && rm nsolid_setup_deb.sh

# Composer
RUN curl -o composer-installer --silent --show-error https://getcomposer.org/installer \
    && php composer-installer --install-dir=/usr/bin --filename=composer \
    && rm composer-installer

# Set document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable apache extensions
RUN a2enmod rewrite \
    && a2enmod headers

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
