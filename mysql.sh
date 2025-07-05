#!/bin/bash
DATABASE_PASS='admin123'
GITHUB_USERNAME="pat-hills"
GITHUB_PAT="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"  # Replace with your GitHub Personal Access Token
REPO_NAME="smartcarelive"
REPO_BRANCH="main"
sudo dnf update -y
sudo dnf install git zip unzip -y
sudo dnf install mariadb105-server -y
# starting & enabling mariadb-server
sudo systemctl start mariadb
sudo systemctl enable mariadb
cd /tmp/
git clone --branch $REPO_BRANCH https://$GITHUB_USERNAME:$GITHUB_PAT@github.com/$GITHUB_USERNAME/$REPO_NAME.git
#restore the dump file for the application
sudo mysqladmin -u root password "$DATABASE_PASS"
sudo mysql -u root -p"$DATABASE_PASS" -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '$DATABASE_PASS'"
sudo mysql -u root -p"$DATABASE_PASS" -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1')"
sudo mysql -u root -p"$DATABASE_PASS" -e "DELETE FROM mysql.user WHERE User=''"
sudo mysql -u root -p"$DATABASE_PASS" -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\_%'"
sudo mysql -u root -p"$DATABASE_PASS" -e "FLUSH PRIVILEGES"
sudo mysql -u root -p"$DATABASE_PASS" -e "create database smart_care_live"
sudo mysql -u root -p"$DATABASE_PASS" -e "grant all privileges on smart_care_live.* TO 'admin'@'localhost' identified by 'admin123'"
sudo mysql -u root -p"$DATABASE_PASS" -e "grant all privileges on smart_care_live.* TO 'admin'@'%' identified by 'admin123'"
sudo mysql -u root -p"$DATABASE_PASS" smart_care_live < /tmp/smartcarelive/database/smart_care_live.sql
sudo mysql -u root -p"$DATABASE_PASS" -e "FLUSH PRIVILEGES"
