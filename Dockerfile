FROM php:8.2-fpm

# Install packages
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN apt-get update && apt-get install -y nginx supervisor zip unzip git

COPY . /var/wwww/html/fabriquepar
WORKDIR /var/wwww/html/fabriquepar

# Create fpm socket directories
RUN mkdir /run/php && mkdir /run/supervisor
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

# Permissions given to the www-data user a rootless usage
RUN chown -R www-data:www-data /var/wwww/html/fabriquepar && \
    chown -R www-data:www-data /run/php && \
    chown -R www-data:www-data /run/supervisor && \
    chown -R www-data:www-data /var/lib/nginx && \
    chown -R www-data:www-data /var/log/nginx
    
RUN touch /run/supervisord.pid && chown www-data:www-data /run/supervisord.pid && \
    touch /run/nginx.pid && chown www-data:www-data /run/nginx.pid

RUN chmod -R 775 /var/wwww/html/fabriquepar/storage
RUN chmod -R 775 /var/wwww/html/fabriquepar/bootstrap/cache


# Install composer packages
RUN composer update
RUN composer install
RUN php artisan key:generate

USER www-data

EXPOSE 80

CMD ["/usr/bin/supervisord"]