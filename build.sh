#!/bin/bash

# Function to remove a directory if it exists
remove_directory() {
  if [ -d "$1" ]; then
    echo "Removing '$1' directory..."
    rm -rf "$1"
  fi
}

# Check if the command-line parameter is true before removing 'vendor' directory
if [ "$1" == "true" ]; then
  remove_directory "vendor"
fi

# Check if the command-line parameter is true before removing 'node_modules' directory
if [ "$1" == "true" ]; then
  remove_directory "node_modules"
fi

composer clear-cache
npm cache verify

# Run 'composer install'
echo "Running 'composer install'..."
composer install

# Run 'npm install'
echo "Running 'npm install'..."
npm install

# Run 'npm run build'
echo "Running 'npm run build'..."
npm run build

echo "Clearing laravel cache..."
php artisan cache:clear

echo "All done... Website is ready!"
