#!/bin/bash

# ====================================
# United Travels - cPanel Deployment Script
# ====================================
# Run this script after uploading files to cPanel
# Usage: bash cpanel-deploy.sh

echo "================================================"
echo "  United Travels - Deployment Setup"
echo "================================================"
echo ""

# Change to project directory
cd ~/unitedtravels || { echo "Error: Project directory not found"; exit 1; }

echo "✓ Changed to project directory: $(pwd)"
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo "❌ ERROR: .env file not found!"
    echo "Please create .env file first using the template."
    echo "Location: ~/unitedtravels/.env"
    exit 1
fi

echo "✓ .env file found"
echo ""

# Check if composer exists, if not use php composer
if [ -f "composer" ]; then
    COMPOSER="php composer"
elif command -v composer &> /dev/null; then
    COMPOSER="composer"
else
    echo "Installing Composer..."
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    mv composer.phar composer
    COMPOSER="php composer"
    echo "✓ Composer installed"
fi

echo ""
echo "Step 1: Installing PHP dependencies..."
echo "========================================"
$COMPOSER install --optimize-autoloader --no-dev
if [ $? -eq 0 ]; then
    echo "✓ Dependencies installed successfully"
else
    echo "❌ Error installing dependencies"
    exit 1
fi

echo ""
echo "Step 2: Generating application key..."
echo "========================================"
php artisan key:generate --force
if [ $? -eq 0 ]; then
    echo "✓ Application key generated"
else
    echo "❌ Error generating application key"
    exit 1
fi

echo ""
echo "Step 3: Setting file permissions..."
echo "========================================"
chmod -R 775 storage
chmod -R 775 bootstrap/cache
find storage -type f -exec chmod 664 {} \;
find storage -type d -exec chmod 775 {} \;
find bootstrap/cache -type f -exec chmod 664 {} \;
find bootstrap/cache -type d -exec chmod 775 {} \;
echo "✓ Permissions set successfully"

echo ""
echo "Step 4: Creating storage symbolic link..."
echo "========================================"
php artisan storage:link
if [ $? -eq 0 ]; then
    echo "✓ Storage link created"
else
    echo "⚠ Warning: Storage link might already exist or need manual creation"
    # Try manual symlink creation
    cd ~/public_html || exit
    rm -rf storage 2>/dev/null
    ln -s ~/unitedtravels/storage/app/public storage
    cd ~/unitedtravels || exit
    echo "✓ Manual storage link created"
fi

echo ""
echo "Step 5: Running database migrations..."
echo "========================================"
php artisan migrate --force
if [ $? -eq 0 ]; then
    echo "✓ Migrations completed successfully"
else
    echo "❌ Error running migrations"
    echo "Please check your database credentials in .env file"
    exit 1
fi

echo ""
echo "Step 6: Seeding database..."
echo "========================================"
php artisan db:seed --force
if [ $? -eq 0 ]; then
    echo "✓ Database seeded successfully"
else
    echo "❌ Error seeding database"
    echo "Please check if ROOT_ADMIN_EMAIL and ROOT_ADMIN_PASSWORD are set in .env"
    exit 1
fi

echo ""
echo "Step 7: Caching configuration..."
echo "========================================"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
echo "✓ Caches cleared"

php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✓ Caches rebuilt"

echo ""
echo "Step 8: Optimizing autoloader..."
echo "========================================"
$COMPOSER dump-autoload --optimize
echo "✓ Autoloader optimized"

echo ""
echo "Step 9: Final permissions check..."
echo "========================================"
chmod -R 775 storage/logs
chmod -R 775 storage/framework
chmod -R 775 storage/app/public
echo "✓ Final permissions set"

echo ""
echo "================================================"
echo "  ✅ DEPLOYMENT COMPLETED SUCCESSFULLY!"
echo "================================================"
echo ""
echo "Next steps:"
echo "1. Visit your website: https://yourdomain.com"
echo "2. Login to admin panel: https://yourdomain.com/login"
echo "3. Use credentials from ROOT_ADMIN_EMAIL and ROOT_ADMIN_PASSWORD in .env"
echo ""
echo "If you encounter any issues:"
echo "- Check logs: tail -f storage/logs/laravel.log"
echo "- Verify .env settings"
echo "- Check file permissions"
echo ""
echo "================================================"

