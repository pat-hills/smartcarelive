#!/bin/bash

set -e

# --- CONFIGURE ---
GITHUB_USERNAME="pat-hills"
GITHUB_PAT="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"  # Replace with your GitHub Personal Access Token
REPO_NAME="smartcarelive"
REPO_BRANCH="main"
APP_DIR="/var/www/html"

echo "==============================="
echo "   PHP Deployment from GitHub  "
echo "==============================="

if [[ $EUID -ne 0 ]]; then
   echo "Please run as root (use sudo)."
   exit 1
fi

echo "Updating system..."
apt update && apt upgrade -y

echo "Installing Apache and PHP..."
apt install -y apache2 php libapache2-mod-php php-mysql php-cli php-curl php-zip php-mbstring unzip git

echo "Starting Apache..."
systemctl enable apache2
systemctl start apache2

echo "Cleaning default web directory..."
rm -rf $APP_DIR/*

echo "Cloning private GitHub repo..."
git clone --branch $REPO_BRANCH https://$GITHUB_USERNAME:$GITHUB_PAT@github.com/$GITHUB_USERNAME/$REPO_NAME.git /tmp/$REPO_NAME

echo "Moving app to web root..."
mv /tmp/$REPO_NAME/* $APP_DIR

echo "Setting permissions..."
chown -R www-data:www-data $APP_DIR
chmod -R 755 $APP_DIR

echo "Restarting Apache..."
systemctl restart apache2

echo "==============================="
echo "Deployment Complete!"
echo "Access your app via EC2 Public IP"
echo "==============================="
