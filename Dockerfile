FROM php:8.2-fpm

# Install packages
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN apt-get update && apt-get install -y nginx supervisor zip unzip git

COPY . /var/www/html/fabriquepar
WORKDIR /var/www/html/fabriquepar

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

# Permissions given to the root (GID:0) group a rootless usage
RUN chgrp -R root /var/www/html/fabriquepar && chmod -R g+rwX /var/www/html/fabriquepar && \
    chgrp -R root /run/php && chmod -R g+rwX /run/php && \
    chgrp -R root /run/supervisor && chmod -R g+rwX /run/supervisor && \
    chgrp -R root /var/lib/nginx && chmod -R g+rwX /var/lib/nginx && \
    chgrp -R root /var/log/nginx && chmod -R g+rwX /var/log/nginx
    
RUN touch /run/supervisord.pid && chgrp root /run/supervisord.pid && chmod -R g+rwX /run/supervisord.pid && \
    touch /run/nginx.pid && chgrp root /run/nginx.pid && chmod -R g+rwX /run/nginx.pid

RUN chmod -R 775 /var/www/html/fabriquepar/storage
RUN chmod -R 775 /var/www/html/fabriquepar/bootstrap/cache

# Install composer packages
RUN composer update
RUN composer install
RUN php artisan key:generate

USER 1001:root

EXPOSE 8080

CMD ["/usr/bin/supervisord"]