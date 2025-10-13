# 📋 cPanel Deployment Checklist - United Travels

## ✅ STEP-BY-STEP GUIDE

Follow this checklist in order. Check off each item as you complete it.

---

## 📝 **INFORMATION YOU'LL NEED**

Before starting, have these ready:
- [ ] cPanel login URL (usually: `unitedtravel.ma/cpanel` or `unitedtravel.ma:2083`)
- [ ] cPanel username
- [ ] cPanel password
- [ ] Your domain name
- [ ] FTP/SSH credentials (from cPanel)

---

## 🗄️ **PART 1: DATABASE SETUP (In cPanel)**

### 1.1 Login to cPanel
- [ ] Go to your cPanel URL
- [ ] Login with your credentials

### 1.2 Create MySQL Database
- [ ] Find and click **"MySQL® Databases"** icon
- [ ] In "Create New Database" section:
  - [ ] Database Name: `unitedtravels_db`
  - [ ] Click "Create Database"
  - [ ] ✅ Success message should appear

### 1.3 Create Database User
- [ ] Scroll to "MySQL Users" section
- [ ] In "Add New User":
  - [ ] Username: `unitedtravels_user`
  - [ ] Click "Password Generator" for strong password
  - [ ] **COPY AND SAVE THIS PASSWORD** - You'll need it!
  - [ ] Click "Create User"

### 1.4 Add User to Database
- [ ] Scroll to "Add User To Database"
- [ ] Select User: `unitedtravels_user`
- [ ] Select Database: `unitedtravels_db`
- [ ] Click "Add"
- [ ] On privileges page, check **"ALL PRIVILEGES"**
- [ ] Click "Make Changes"
- [ ] ✅ User added successfully

### 1.5 Note Your Database Credentials

**Write these down - you'll need them for .env file:**

```
Database Name: cpanelusername_unitedtravels_db
Database User: cpanelusername_unitedtravels_user
Database Password: [the password you generated]
Database Host: localhost
```

*Note: Replace `cpanelusername` with your actual cPanel username*

---

## 🐘 **PART 2: PHP CONFIGURATION (In cPanel)**

### 2.1 Check PHP Version
- [ ] Find and click **"Select PHP Version"** or **"MultiPHP Manager"**
- [ ] Check current PHP version
- [ ] If PHP version is less than 8.2:
  - [ ] Select your domain
  - [ ] Choose **PHP 8.2** or higher
  - [ ] Click "Apply"

### 2.2 Enable PHP Extensions
- [ ] Click **"Switch to PHP Options"** or **"PHP Extensions"**
- [ ] Enable these extensions (check the boxes):
  - [ ] bcmath
  - [ ] ctype
  - [ ] fileinfo
  - [ ] gd
  - [ ] json
  - [ ] mbstring
  - [ ] openssl
  - [ ] pdo
  - [ ] pdo_mysql
  - [ ] tokenizer
  - [ ] xml
  - [ ] zip
- [ ] Click "Save" or "Apply"

### 2.3 Adjust PHP Settings
- [ ] Go to **"Select PHP Version"** → **"Switch to PHP Options"**
- [ ] Set these values:
  - [ ] `memory_limit`: **256M** (or higher)
  - [ ] `max_execution_time`: **300**
  - [ ] `upload_max_filesize`: **10M**
  - [ ] `post_max_size`: **10M**
- [ ] Click "Save" or "Apply"

---

## 📂 **PART 3: FILE STRUCTURE SETUP (In cPanel File Manager)**

### 3.1 Open File Manager
- [ ] Click **"File Manager"** in cPanel

### 3.2 Create Application Folder
- [ ] Navigate to `/home/yourusername/`
- [ ] Click **"+ Folder"** or **"New Folder"**
- [ ] Name it: `unitedtravels`
- [ ] Click "Create New Folder"

### 3.3 Prepare public_html
- [ ] Navigate to `/home/yourusername/public_html/`
- [ ] **IMPORTANT:** If there are existing files:
  - [ ] Select all files
  - [ ] Move them to a backup folder (create `old_site_backup` folder)
- [ ] public_html should now be empty (or only contain .htaccess)

---

## 📤 **PART 4: UPLOAD FILES**

### Option A: Using cPanel File Manager

#### 4.1 Upload Project Archive
- [ ] **On your local machine**, create deployment package:
  - Open terminal in project folder
  - Run: `npm run build` (to build assets)
  - Create a ZIP of entire project
  - **Exclude:** `.env`, `node_modules/`, `.git/`, `vendor/`

- [ ] Back in cPanel File Manager
- [ ] Navigate to `/home/yourusername/unitedtravels/`
- [ ] Click **"Upload"**
- [ ] Select your project ZIP file
- [ ] Wait for upload to complete
- [ ] Right-click on ZIP file → **"Extract"**
- [ ] Delete the ZIP file after extraction

#### 4.2 Move Public Folder Contents
- [ ] Navigate to `/home/yourusername/unitedtravels/public/`
- [ ] Select **ALL files and folders** inside public/
  - [ ] index.php
  - [ ] .htaccess
  - [ ] assets/
  - [ ] robots.txt
  - [ ] favicon.ico
  - [ ] etc.
- [ ] Click **"Move"**
- [ ] Move to: `/home/yourusername/public_html/`
- [ ] Click "Move Files"
- [ ] ✅ Files moved successfully

---

## ⚙️ **PART 5: CONFIGURATION FILES**

### 5.1 Create .env File
- [ ] Navigate to `/home/yourusername/unitedtravels/`
- [ ] Click **"+ File"** or **"New File"**
- [ ] Name it: `.env`
- [ ] Right-click on `.env` → **"Edit"**
- [ ] Copy the .env template from `CPANEL_ENV_TEMPLATE.txt` file
- [ ] **Update these values:**
  - [ ] `APP_URL=https://yourdomain.com`
  - [ ] `DB_DATABASE=` (your database name from Part 1.5)
  - [ ] `DB_USERNAME=` (your database user from Part 1.5)
  - [ ] `DB_PASSWORD=` (your database password from Part 1.5)
  - [ ] `MAIL_USERNAME=` (your email)
  - [ ] `MAIL_PASSWORD=` (your email app password)
  - [ ] `ROOT_ADMIN_EMAIL=` (your admin email)
  - [ ] `ROOT_ADMIN_PASSWORD=` (choose strong password)
- [ ] Click "Save Changes"

### 5.2 Update index.php
- [ ] Navigate to `/home/yourusername/public_html/`
- [ ] Right-click on `index.php` → **"Edit"**
- [ ] Find this line (around line 16):
  ```php
  require __DIR__.'/../vendor/autoload.php';
  ```
- [ ] Replace with:
  ```php
  require __DIR__.'/../unitedtravels/vendor/autoload.php';
  ```
- [ ] Find this line (around line 18):
  ```php
  $app = require_once __DIR__.'/../bootstrap/app.php';
  ```
- [ ] Replace with:
  ```php
  $app = require_once __DIR__.'/../unitedtravels/bootstrap/app.php';
  ```
- [ ] Click "Save Changes"

---

## 🔧 **PART 6: TERMINAL COMMANDS (Via SSH)**

### 6.1 Access Terminal
- [ ] **Option 1:** Click **"Terminal"** in cPanel (if available)
- [ ] **Option 2:** Use SSH client (PuTTY on Windows, Terminal on Mac/Linux)
  ```bash
  ssh yourusername@yourdomain.com -p 22
  ```

### 6.2 Navigate to Project
```bash
cd ~/unitedtravels
```

### 6.3 Install Composer (if not installed)
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar composer
```

### 6.4 Run Deployment Script
- [ ] Run the prepared script:
```bash
bash cpanel-deploy.sh
```

**OR manually run these commands:**

```bash
# Install dependencies
php composer install --optimize-autoloader --no-dev

# Generate app key
php artisan key:generate

# Set permissions
chmod -R 775 storage bootstrap/cache

# Create storage link
php artisan storage:link

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔒 **PART 7: SSL CERTIFICATE (HTTPS)**

### 7.1 Install SSL
- [ ] Go back to cPanel main page
- [ ] Find **"SSL/TLS Status"**
- [ ] Click **"Run AutoSSL"**
- [ ] Wait for certificate to be installed
- [ ] ✅ SSL certificate active

### 7.2 Force HTTPS
- [ ] In File Manager, navigate to `/home/yourusername/public_html/`
- [ ] Edit `.htaccess`
- [ ] After `RewriteEngine On`, add:
  ```apache
  RewriteCond %{HTTPS} off
  RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
  ```
- [ ] Save

---

## ✅ **PART 8: TESTING**

### 8.1 Test Website
- [ ] Visit: `https://yourdomain.com`
- [ ] Should see homepage ✅

### 8.2 Test Admin Login
- [ ] Go to: `https://yourdomain.com/login`
- [ ] Login with ROOT_ADMIN_EMAIL and ROOT_ADMIN_PASSWORD
- [ ] Should access admin dashboard ✅

### 8.3 Test Features
- [ ] Browse destinations page
- [ ] Try creating a test tour
- [ ] Upload a test image
- [ ] Check contact form
- [ ] Verify email sending works

---

## 🐛 **TROUBLESHOOTING**

### If you see "500 Internal Server Error":
```bash
cd ~/unitedtravels
chmod -R 775 storage bootstrap/cache
php artisan cache:clear
php artisan config:clear
```

### If images don't load:
```bash
cd ~/public_html
ln -s ~/unitedtravels/storage/app/public storage
chmod -R 775 ~/unitedtravels/storage/app/public
```

### To check error logs:
```bash
tail -f ~/unitedtravels/storage/logs/laravel.log
```

---

## 🎉 **DEPLOYMENT COMPLETE!**

Once all items are checked off, your site should be live!

**Important URLs:**
- Frontend: `https://yourdomain.com`
- Admin Panel: `https://yourdomain.com/admin/dashboard`
- Destinations: `https://yourdomain.com/destinations`

**Next Steps:**
1. Change your admin password after first login
2. Add tours through admin panel
3. Configure email settings thoroughly
4. Set up regular backups
5. Monitor error logs regularly

---

**Need Help?** Check the error logs or consult your hosting provider's support.

