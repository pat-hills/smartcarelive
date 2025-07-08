#!/bin/bash

set -e


# --- CONFIGURE ---
GITHUB_USERNAME="pat-hills"
GITHUB_PAT="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"  # Replace with your GitHub Personal Access Token
REPO_NAME="smartcarelive"
REPO_BRANCH="main"
APP_DIR="/var/www/html"

echo "Updating application code from GitHub..."

if [ ! -d "$APP_DIR/.git" ]; then
    echo "No Git repo found. Cloning afresh..."
    sudo rm -rf $APP_DIR/*
    git clone --branch $REPO_BRANCH https://$GITHUB_USERNAME:$GITHUB_PAT@github.com/$GITHUB_USERNAME/$REPO_NAME.git $APP_DIR
else
    echo "Git repo found. Pulling latest changes..."
    cd $APP_DIR
    git pull origin $REPO_BRANCH
fi

echo "Setting permissions..."
chown -R www-data:www-data $APP_DIR
chmod -R 755 $APP_DIR

echo "Restarting Apache..."
sudo systemctl restart apache2

echo "✅ Update complete!"


# --- Additional Notes ---
# sudo mkdir -p /opt/deploy-scripts
# cd /opt/deploy-scripts

#  sudo nano update-app.sh #CREATE THIS FILE 
# sudo chmod +x update-app.sh #MAKE IT EXECUTABLE

# sudo ln -s /opt/deploy-scripts/update-app.sh /usr/local/bin/update-app #mAKE IT SYMLINKED TO /usr/local/bin

# sudo update-app # Run it everywhere



# If you have any custom configurations, ensure they are preserved.
# Always backup your application and database before running updates.

# Delete everything in the /var/www/html directory before pulling the latest code.

# sudo find /var/www/html -mindepth 1 -delete

