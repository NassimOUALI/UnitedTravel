# Deployment & Update Guide - United Travels

## 🚀 Initial Deployment to Web Server

### Prerequisites
- Web server with PHP 8.2+ and MySQL 8.0+
- Composer installed
- Node.js and npm installed
- Domain name configured

### Step 1: Upload Files
```bash
# Upload your entire project to the server
# Typically to /home/yourusername/public_html/ or /var/www/html/

# Make sure to exclude these (they'll be regenerated):
- node_modules/
- vendor/
- .env (create new on server)
```

### Step 2: Set Proper Permissions
```bash
cd /path/to/your/project

# Storage and cache folders need write permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# If using shared hosting
chown -R youruser:yourgroup storage
chown -R youruser:yourgroup bootstrap/cache
```

### Step 3: Configure Environment
```bash
# Copy the example environment file
cp .env.example .env

# Edit .env with your production settings
nano .env
```

**Important .env Settings for Production:**
```env
APP_NAME="United Travels"
APP_ENV=production
APP_DEBUG=false  # NEVER true in production!
APP_URL=https://yourwebsite.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_secure_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=unitedtravelandservice@gmail.com
MAIL_PASSWORD=your_smtp_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=unitedtravelandservice@gmail.com
MAIL_FROM_NAME="United Travels"
MAIL_ADMIN_ADDRESS=nassiox@gmail.com
```

### Step 4: Install Dependencies
```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node dependencies
npm install

# Build assets for production
npm run build
```

### Step 5: Setup Application
```bash
# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Seed the database (only first time)
php artisan db:seed --force

# Create storage link
php artisan storage:link

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### Step 6: Configure Web Server

#### For Apache (.htaccess)
Your Laravel installation should already have a `.htaccess` file in the `public` folder.

**Update your Apache VirtualHost or .htaccess:**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### For Nginx
```nginx
server {
    listen 80;
    server_name yourwebsite.com;
    root /path/to/your/project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Step 7: SSL Certificate (HTTPS)
```bash
# If using cPanel, use AutoSSL or Let's Encrypt from the interface

# If using command line (Let's Encrypt)
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourwebsite.com -d www.yourwebsite.com

# Auto-renewal (cron job)
0 12 * * * /usr/bin/certbot renew --quiet
```

---

## 🔄 How to Update Your App (After Making Changes)

### Scenario 1: You Made Changes Locally and Want to Deploy

#### Option A: Using Git (Recommended)
```bash
# On your local machine
git add .
git commit -m "Your descriptive commit message"
git push origin main

# On your server
cd /path/to/your/project
git pull origin main

# Run update commands
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan migrate --force
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### Option B: Manual Upload (FTP/SFTP)
```bash
# 1. Upload changed files to server

# 2. SSH into server and run:
cd /path/to/your/project

# 3. If you modified .env
php artisan config:clear

# 4. If you added/modified migrations
php artisan migrate --force

# 5. If you changed routes
php artisan route:clear
php artisan route:cache

# 6. If you changed views
php artisan view:clear
php artisan view:cache

# 7. If you changed config files
php artisan config:clear
php artisan config:cache

# 8. If you changed composer.json
composer install --optimize-autoloader --no-dev
composer dump-autoload --optimize

# 9. If you changed package.json or assets
npm install
npm run build
```

### Scenario 2: Quick View/CSS/JS Changes
```bash
# If you only changed Blade files or CSS/JS
npm run build
php artisan view:clear
php artisan view:cache
```

### Scenario 3: Database Changes
```bash
# If you added new migrations
php artisan migrate --force

# If you want to seed new data
php artisan db:seed --force

# If you need to refresh everything (⚠️ WARNING: Deletes all data!)
php artisan migrate:fresh --seed --force
```

### Scenario 4: Added New Images/Assets
```bash
# Upload to public/assets/img/ or storage/app/public/
# No special commands needed, just upload via FTP/SFTP
```

### Scenario 5: Environment Changes (.env)
```bash
# After editing .env file
php artisan config:clear
php artisan config:cache

# Restart PHP-FPM (if needed)
sudo systemctl restart php8.2-fpm
```

---

## 🔧 Maintenance Commands

### Regular Maintenance (Weekly)
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Check Application Status
```bash
# Check Laravel version
php artisan --version

# Check environment
php artisan env

# List all routes
php artisan route:list

# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();
```

### Optimize Performance
```bash
# Clear and rebuild all caches
php artisan optimize

# To undo optimization (for development)
php artisan optimize:clear
```

### View Logs
```bash
# View latest logs
tail -f storage/logs/laravel.log

# View last 50 lines
tail -n 50 storage/logs/laravel.log

# Search for errors
grep "ERROR" storage/logs/laravel.log
```

---

## 🐛 Troubleshooting

### "500 Internal Server Error"
```bash
# 1. Check permissions
chmod -R 775 storage bootstrap/cache

# 2. Check logs
tail -f storage/logs/laravel.log

# 3. Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Check .env file
php artisan config:clear
```

### "404 Not Found" on Routes
```bash
# 1. Clear route cache
php artisan route:clear

# 2. Rebuild route cache
php artisan route:cache

# 3. Check web server configuration
# Make sure document root points to /public folder
```

### Images Not Loading
```bash
# 1. Recreate storage link
php artisan storage:link

# 2. Check permissions
chmod -R 775 storage/app/public
```

### Email Not Sending
```bash
# 1. Check .env mail settings
cat .env | grep MAIL

# 2. Test email
php artisan tinker
>>> Mail::raw('Test', function($msg) { $msg->to('test@example.com')->subject('Test'); });

# 3. Check logs
tail -f storage/logs/laravel.log
```

### Database Connection Failed
```bash
# 1. Check database credentials in .env
# 2. Test connection
php artisan tinker
>>> DB::connection()->getPdo();

# 3. Check if database exists
mysql -u your_user -p
mysql> SHOW DATABASES;
```

---

## 📦 Backup Strategy

### What to Backup
1. **Database** (Most important!)
2. **Uploaded files** (`storage/app/public/`)
3. **Environment file** (`.env`)
4. **Custom code** (if not using Git)

### Automated Database Backup
```bash
# Create backup script: backup.sh
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u your_user -pyour_password your_database > backup_$DATE.sql
gzip backup_$DATE.sql

# Add to crontab (daily at 2 AM)
0 2 * * * /path/to/backup.sh
```

### Manual Backup
```bash
# Backup database
php artisan db:backup  # If you have backup package
# OR
mysqldump -u user -p database_name > backup.sql

# Backup files
tar -czf storage_backup.tar.gz storage/app/public/
tar -czf project_backup.tar.gz /path/to/project
```

---

## 🔒 Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_ENV=production`
- [ ] Strong `APP_KEY` generated
- [ ] Secure database password
- [ ] HTTPS/SSL enabled
- [ ] `.env` file not accessible via web
- [ ] `storage/` not accessible via web
- [ ] Regular backups configured
- [ ] File permissions set correctly (775 for folders, 664 for files)
- [ ] Keep Laravel and packages updated
- [ ] Monitor `storage/logs/laravel.log` regularly

---

## 🚀 Quick Update Checklist

When you make changes and want to deploy:

1. [ ] Test changes locally
2. [ ] Commit to Git (if using)
3. [ ] Upload changed files to server OR pull from Git
4. [ ] Run `composer install --optimize-autoloader --no-dev` (if composer.json changed)
5. [ ] Run `npm install && npm run build` (if package.json or assets changed)
6. [ ] Run `php artisan migrate --force` (if migrations added)
7. [ ] Clear caches: `php artisan cache:clear config:clear route:clear view:clear`
8. [ ] Rebuild caches: `php artisan config:cache route:cache view:cache`
9. [ ] Test the website
10. [ ] Check logs for errors

---

## 📞 Emergency Rollback

If something breaks after an update:

```bash
# If using Git
git reset --hard HEAD~1  # Go back one commit
# OR
git checkout previous-stable-commit-hash

# Clear everything
php artisan optimize:clear
php artisan cache:clear

# Rebuild
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

**Remember**: Always test changes on a staging environment before deploying to production!

**Pro Tip**: Keep a local development copy that matches production exactly for testing.

