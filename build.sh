#!/bin/bash

if [ -d "vendor" ]; then
  echo "Removing 'vendor' directory..."
  rm -rf vendor
fi

# Remove the 'node_modules' directory if it exists
if [ -d "node_modules" ]; then
  echo "Removing 'node_modules' directory..."
  rm -rf node_modules
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
