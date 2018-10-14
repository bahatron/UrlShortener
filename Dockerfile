FROM php:7.2.10-apache

RUN apt-get update \ 
    && apt-get -y --no-install-recommends install git zip zlib1g-dev \ 
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* 

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo

WORKDIR /var/www/html

COPY . /var/www/html
