#!/bin/sh

# Stop execution if a step fails
set -e

DOCKER_USERNAME=lbaw2113  # Replace by your docker hub username
IMAGE_NAME=lbaw2013       # Replace with your group's image name

# Ensure that dependencies are available
composer install
php artisan clear-compiled
php artisan optimize

sudo docker build -t "$DOCKER_USERNAME/$IMAGE_NAME" .
sudo docker push "$DOCKER_USERNAME/$IMAGE_NAME"
