#!/bin/bash

# Detect Laravel environment
if [ -f ".env" ]; then
  ENVIRONMENT=$(grep -E "^APP_ENV=" .env | cut -d '=' -f2)
else
  ENVIRONMENT="production" # Default to production if .env is missing
fi

echo "Detected Environment: $ENVIRONMENT"

# Rename the correct .htaccess file inside the public folder
if [ "$ENVIRONMENT" == "local" ]; then
  echo "Using public/.htaccess-local..."
  yes | cp -rf public/.htaccess-local public/.htaccess
elif [ "$ENVIRONMENT" == "production" ]; then
  echo "Using public/.htaccess-prod..."
  yes | cp -rf public/.htaccess-prod public/.htaccess
else
  echo "Unknown environment ($ENVIRONMENT). No changes to public/.htaccess."
fi

# Remove the 'vendor' directory if it exists
if [ -d "vendor" ]; then
  echo "Removing 'vendor' directory..."
  rm -rf vendor
fi

# Remove the 'node_modules' directory if it exists
if [ -d "node_modules" ]; then
  echo "Removing 'node_modules' directory..."
  rm -rf node_modules
fi

# Clear caches
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

# Clear Laravel cache
echo "Clearing Laravel cache..."
php artisan optimize:clear

# Generate JavaScript localization files
php artisan lang:js -c -s ./lang

echo "All done... Website is ready!"
