# 🚀 Quick cPanel Deployment Guide

## 📦 Files You Need

Three important files have been created for your deployment:

1. **`CPANEL_DEPLOYMENT_CHECKLIST.md`** - Complete step-by-step checklist
2. **`CPANEL_ENV_TEMPLATE.txt`** - Template for your .env file
3. **`cpanel-deploy.sh`** - Automated setup script for terminal

---

## ⚡ Quick Start (5 Main Steps)

### 1️⃣ IN CPANEL - Create Database (2 minutes)

```
cPanel → MySQL® Databases

Create Database:
- Name: unitedtravels_db

Create User:
- Username: unitedtravels_user
- Password: [use generator]

Add User to Database:
- Grant ALL PRIVILEGES

✏️ WRITE DOWN:
- Full database name: cpanelusername_unitedtravels_db
- Full username: cpanelusername_unitedtravels_user
- Password: [the generated password]
```

### 2️⃣ IN CPANEL - Check PHP (1 minute)

```
cPanel → Select PHP Version or MultiPHP Manager

✅ Set PHP 8.2 or higher
✅ Enable extensions: bcmath, mbstring, pdo_mysql, gd, zip, xml
✅ memory_limit: 256M
✅ upload_max_filesize: 10M
```

### 3️⃣ UPLOAD FILES (10 minutes)

**Option A: File Manager**
```
1. Build assets locally: npm run build
2. ZIP your project (exclude: .env, node_modules, .git, vendor)
3. cPanel → File Manager
4. Upload ZIP to ~/unitedtravels/
5. Extract ZIP
6. Move ~/unitedtravels/public/* to ~/public_html/
```

**Option B: FTP**
```
1. Build assets locally: npm run build
2. Upload all files (except public/) to ~/unitedtravels/
3. Upload public/* contents to ~/public_html/
```

### 4️⃣ CONFIGURE (5 minutes)

**A. Create .env file:**
```
File Manager → ~/unitedtravels/ → New File: .env
Copy content from CPANEL_ENV_TEMPLATE.txt
Update these values:
- APP_URL
- DB_DATABASE, DB_USERNAME, DB_PASSWORD (from Step 1)
- MAIL_USERNAME, MAIL_PASSWORD
- ROOT_ADMIN_EMAIL, ROOT_ADMIN_PASSWORD
```

**B. Update index.php:**
```
File Manager → ~/public_html/index.php → Edit

Find (line ~16):
require __DIR__.'/../vendor/autoload.php';

Replace with:
require __DIR__.'/../unitedtravels/vendor/autoload.php';

Find (line ~18):
$app = require_once __DIR__.'/../bootstrap/app.php';

Replace with:
$app = require_once __DIR__.'/../unitedtravels/bootstrap/app.php';

Save.
```

### 5️⃣ RUN SETUP (3 minutes)

**Via SSH/Terminal:**
```bash
cd ~/unitedtravels
bash cpanel-deploy.sh
```

**Or manually:**
```bash
cd ~/unitedtravels
php composer install --optimize-autoloader --no-dev
php artisan key:generate
chmod -R 775 storage bootstrap/cache
php artisan storage:link
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ✅ DONE!

Visit: `https://yourdomain.com`

Login: `https://yourdomain.com/login`
- Email: [your ROOT_ADMIN_EMAIL]
- Password: [your ROOT_ADMIN_PASSWORD]

---

## 🐛 Common Issues & Fixes

### "500 Internal Server Error"
```bash
cd ~/unitedtravels
chmod -R 775 storage bootstrap/cache
php artisan cache:clear
php artisan config:clear
```

### Images not loading
```bash
cd ~/public_html
ln -s ~/unitedtravels/storage/app/public storage
```

### Check errors
```bash
tail -f ~/unitedtravels/storage/logs/laravel.log
```

---

## 📞 Need More Help?

See full guide: `CPANEL_DEPLOYMENT_CHECKLIST.md`

**Database issues?** Check .env credentials match what you created in cPanel.

**Permission issues?** Make sure storage and bootstrap/cache are writable (775).

**Path issues?** Verify index.php paths point to ~/unitedtravels/

---

**That's it! Your United Travels site should now be live! 🎉**

