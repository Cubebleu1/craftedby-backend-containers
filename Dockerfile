FROM php:8.2-fpm
COPY . /usr/src/fabriquepar
WORKDIR /usr/src/fabriquepar

# Install mysql extension
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# # Create FPM pool
# COPY fabriquepar_pool.conf /etc/php/8.2/fpm/pool.d/fabriquepar_pool.conf

# Install Necessary packages
RUN apt-get update && apt-get install -y nginx supervisor zip unzip git

# Create fpm socket directory for php-fpm / nginx
RUN mkdir /run/php
# Create directory for database products seeding (to mount as a volume since the images should be persistent)
RUN mkdir -p public/images/products

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    HASH=`curl -sS https://composer.github.io/installer.sig` && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Copy configuration files
COPY configuration/nginx.conf /etc/nginx/sites-available/default
COPY configuration/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY .env.example .env
COPY configuration/fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Permissions given to the www-data user
RUN chown -R :www-data /usr/src/fabriquepar
RUN chown -R :www-data /run/php
RUN chmod -R 775 /usr/src/fabriquepar/storage
RUN chmod -R 775 /usr/src/fabriquepar/bootstrap/cache


# Install composer packages
RUN composer update
RUN composer install
RUN php artisan key:generate

EXPOSE 80

CMD ["/usr/bin/supervisord"]