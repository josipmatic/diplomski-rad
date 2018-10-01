FROM php:5.6-apache

RUN usermod -u 1000 www-data
RUN usermod -G staff www-data

RUN echo "ServerName localhost" | tee /etc/apache2/conf-available/servername.conf
RUN a2enconf servername
RUN a2enmod rewrite
RUN a2enmod expires
RUN a2enmod headers
RUN service apache2 restart

# Update apt-get
RUN apt-get update

# Install MySql client
RUN apt-get install -y --force-yes mysql-client

# Install php extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring

# Install wget
RUN apt-get install -y --force-yes wget

# Install wp-cli
RUN wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

# Autoremove
RUN apt-get autoremove -y
