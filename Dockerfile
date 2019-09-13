ARG PORT
ARG ALPINE

# Base Image
FROM alpine:$ALPINE

# Install packages
RUN apk --no-cache add php7-mysqli php7 php7-fpm php7-json php7-openssl php7-curl php7-pdo_mysql php7-common \
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-session \
    php7-mbstring php7-gd nginx supervisor curl php7-memcached

# Configure nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY docker/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY docker/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Make sure files/folders needed by the
# processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/tmp/nginx && \
  chown -R nobody.nobody /var/log/nginx

# Setup document root
RUN mkdir -p /var/www

# Switch to use
# A non-root user
USER nobody

# Add application
WORKDIR /var/www
COPY --chown=nobody src/ /var/www/

# listen
EXPOSE $PORT

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:$PORT/fpm-ping
