#!/bin/bash

# To .htaccess routing work

sudo nano /etc/apache2/apache2.conf

# Scroll to find

<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride None
    Require all granted
</Directory>


# Change AllowOverride None to AllowOverride All

<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>


# Save and exit (Ctrl + X, then Y, then Enter) and run

sudo a2enmod rewrite
sudo systemctl restart apache2


#MYSQL Database Setup

#ALLOW remote access to the database

sudo nano /etc/my.cnf.d/mariadb-server.cnf


# Find the line that says bind-address and change it to:
bind-address = 127.0.0.1

#Change it to:
bind-address = 0.0.0.0

# Save and exit (Ctrl + X, then Y, then Enter) and restart the MariaDB service
sudo systemctl restart mariadb
