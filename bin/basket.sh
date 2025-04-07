#!/bin/bash

if [ ! -d "vendor" ]; then
    echo "'vendor' Folder not found. Installing Composer dependencies..."
    composer install
    # composer install --no-dev --optimize-autoloader
else
    echo "'vendor' Folder found, no installation!"
fi

echo 'Baskt app is ready...'
sleep 99999
