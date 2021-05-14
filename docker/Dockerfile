FROM yiisoftware/yii2-php:7.3-apache

ENV LANG pt_BR.UTF-8
ENV LANGUAGE pt_BR:pt
ENV LC_ALL pt_BR.UTF-8

#php extensions & packages
RUN apt-get update && \
    apt-get -y install \
	locales \
    --no-install-recommends && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set the locale
RUN sed -i -e 's/# pt_BR.UTF-8 UTF-8/pt_BR.UTF-8 UTF-8/' /etc/locale.gen && locale-gen

#timezone
RUN ln -sf /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && dpkg-reconfigure --frontend noninteractive tzdata

#certs ssl
RUN mkdir /etc/apache2/ssl/
COPY certs/dev.* /etc/apache2/ssl/

#apache
RUN rm /etc/apache2/sites-enabled/000-default.conf 2> /dev/null
COPY configs/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY configs/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY configs/php.ini /usr/local/etc/php/php.ini
RUN a2enmod rewrite
RUN a2enmod ssl

RUN chown 1000:1000 /app -R
