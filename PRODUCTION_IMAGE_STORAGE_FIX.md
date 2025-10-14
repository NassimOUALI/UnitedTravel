# 🖼️ Production Image Storage Fix

## 🔍 **The Problem**

Images are uploaded successfully but **DON'T DISPLAY** in production (cPanel).

### Why This Happens:

Your application stores images in Laravel's storage system:
- **Files are saved to:** `storage/app/public/`
- **URLs expect images at:** `https://yourdomain.com/storage/...`
- **The link is missing:** Between `public/storage` and `storage/app/public`

---

## 📂 **Where Images Are Stored**

Your app stores images in these locations:

### 1. **Destination Images**
```php
Location: storage/app/public/destinations/
Controller: app/Http/Controllers/Admin/DestinationController.php
Code: $path = $image->storeAs('destinations', $filename, 'public');
Database: 'storage/destinations/filename.jpg'
```

### 2. **Tour Images**
```php
Location: storage/app/public/tours/
Controller: app/Http/Controllers/Admin/TourController.php
Code: $path = $image->storeAs('tours', $filename, 'public');
Database: 'storage/tours/filename.jpg'
```

### 3. **Tour Attachments (PDFs)**
```php
Location: storage/app/public/tour-attachments/
Controller: app/Http/Controllers/Admin/TourController.php
Code: $path = $file->storeAs('tour-attachments', $filename, 'public');
Database: 'storage/tour-attachments/filename.pdf'
```

### 4. **Profile Photos**
```php
Location: storage/app/public/profile_photos/
Controller: app/Http/Controllers/ProfileController.php
Code: $path = $file->store('profile_photos', 'public');
Database: profile_photos/filename.jpg (no 'storage/' prefix)
```

---

## 🔧 **The Solution: Create Storage Link**

Laravel needs a **symbolic link** from `public/storage` to `storage/app/public`.

### **Method 1: Via SSH (Recommended)**

```bash
# Navigate to your project
cd ~/unitedtravels

# Create the symbolic link
php artisan storage:link
```

**Expected output:**
```
The [public/storage] link has been connected to [storage/app/public].
```

---

### **Method 2: Manual Symbolic Link (If artisan fails)**

```bash
# Navigate to public_html
cd ~/public_html

# Remove old storage link if exists
rm -rf storage

# Create new symbolic link
ln -s ~/unitedtravels/storage/app/public storage

# Verify it was created
ls -la storage
```

**Expected output:**
```
lrwxrwxrwx ... storage -> /home/username/unitedtravels/storage/app/public
```

---

### **Method 3: Via cPanel File Manager (Last Resort)**

⚠️ **Note:** cPanel File Manager usually **can't create symbolic links**. If Methods 1 & 2 don't work, you'll need to use **Method 4** below.

---

### **Method 4: Copy Files Instead of Symlink (Alternative)**

If your hosting doesn't support symbolic links, copy files instead:

```bash
# Navigate to public_html
cd ~/public_html

# Create storage directory if it doesn't exist
mkdir -p storage

# Copy all files from storage/app/public to public_html/storage
cp -r ~/unitedtravels/storage/app/public/* storage/

# Set permissions
chmod -R 755 storage
```

⚠️ **WARNING:** With this method, you'll need to **re-copy files** every time new images are uploaded!

---

## ✅ **How to Verify It's Working**

### Step 1: Check if Link Exists

```bash
cd ~/public_html
ls -la | grep storage
```

**Good output:**
```
storage -> /home/username/unitedtravels/storage/app/public
```

### Step 2: Test Image Access

1. Upload a test image through admin panel
2. Note the image filename (e.g., `1234567890_0_test.jpg`)
3. Try to access it directly:
   ```
   https://unitedtravel.ma/storage/destinations/1234567890_0_test.jpg
   ```
4. **If you see the image:** ✅ It's working!
5. **If you see 404 error:** ❌ Continue troubleshooting below

### Step 3: Check File Permissions

```bash
# Check storage directory permissions
ls -la ~/unitedtravels/storage/app/public

# Should show 775 or 755 permissions
```

If permissions are wrong:
```bash
chmod -R 775 ~/unitedtravels/storage/app/public
```

---

## 🐛 **Troubleshooting**

### Problem 1: "storage:link" Command Fails

**Error:**
```
Unable to create symlink
```

**Solution A:** Try manual symlink (Method 2 above)

**Solution B:** Contact hosting support:
```
Hi, I need to create a symbolic link for my Laravel application:
From: public_html/storage
To: unitedtravels/storage/app/public

Can you help create this symlink or enable symlink support?
```

---

### Problem 2: Images Upload But 404 Error

**Check these:**

1. **Verify storage link exists:**
   ```bash
   cd ~/public_html
   ls -la storage
   ```

2. **Check if files actually exist:**
   ```bash
   ls -la ~/unitedtravels/storage/app/public/destinations/
   ls -la ~/unitedtravels/storage/app/public/tours/
   ```

3. **Check .htaccess in public_html:**
   Make sure it doesn't block `/storage` directory

4. **Check directory permissions:**
   ```bash
   chmod -R 775 ~/unitedtravels/storage/app/public
   ```

---

### Problem 3: Some Images Work, Others Don't

This usually means:
- Old images: Uploaded before link was created
- New images: Working correctly

**Solution:** 
```bash
# Verify ALL subdirectories have correct permissions
find ~/unitedtravels/storage/app/public -type d -exec chmod 775 {} \;
find ~/unitedtravels/storage/app/public -type f -exec chmod 664 {} \;
```

---

### Problem 4: Profile Photos Don't Display

Profile photos are stored slightly differently (no 'storage/' prefix in database).

**Check the view files use correct path:**

```php
<!-- CORRECT: -->
<img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile">

<!-- WRONG: -->
<img src="{{ asset($user->profile_photo) }}" alt="Profile">
```

Let me check your current code:

```bash
grep -r "profile_photo" resources/views/
```

---

## 🔄 **Complete Fix Steps (Do This Now)**

### Step 1: SSH into Your Server
```bash
ssh your-username@unitedtravel.ma
```

### Step 2: Navigate to Project
```bash
cd ~/unitedtravels
```

### Step 3: Create Storage Link
```bash
php artisan storage:link
```

### Step 4: Set Permissions
```bash
chmod -R 775 storage/app/public
chmod -R 775 bootstrap/cache
```

### Step 5: Verify Link
```bash
cd ~/public_html
ls -la storage
```

**You should see:**
```
storage -> /home/username/unitedtravels/storage/app/public
```

### Step 6: Test Upload
1. Go to admin panel: `https://unitedtravel.ma/admin/dashboard`
2. Upload a test destination image
3. View the destination on frontend
4. **Image should display!** ✅

---

## 🚨 **If Symbolic Links Don't Work on Your Host**

Some hosting providers **disable symbolic links** for security. If that's your case:

### **Option A: Contact Support**
Ask them to enable symlinks or create the link for you.

### **Option B: Alternative Storage Solution**

We can modify your code to store images directly in `public/` instead of `storage/`:

**Would need to change:**
1. `DestinationController.php` - Change storage location
2. `TourController.php` - Change storage location
3. `ProfileController.php` - Change storage location

**Pros:** Works without symlinks
**Cons:** Less secure, files not protected by Laravel

---

## 📋 **Quick Checklist**

After following the fix:

- [ ] SSH access working
- [ ] Navigated to `~/unitedtravels`
- [ ] Ran `php artisan storage:link`
- [ ] Saw success message
- [ ] Verified link exists in `~/public_html/storage`
- [ ] Set permissions 775 on storage
- [ ] Uploaded test image in admin
- [ ] Image displays on frontend ✅
- [ ] All old images also display ✅

---

## 🆘 **Still Not Working?**

### **Send this info for further help:**

```bash
# Run these commands and send output:

# 1. Check if storage link exists
ls -la ~/public_html/storage

# 2. Check if images exist
ls -la ~/unitedtravels/storage/app/public/

# 3. Check permissions
ls -la ~/unitedtravels/storage/app/

# 4. Test artisan command
cd ~/unitedtravels && php artisan storage:link

# 5. Check web server error logs
tail -50 ~/unitedtravels/storage/logs/laravel.log
```

---

## 💡 **Pro Tips**

1. **Always run `php artisan storage:link` after deployment**
2. **Check permissions if images suddenly stop working**
3. **Backup storage folder before making changes**
4. **Test with one image before bulk uploading**
5. **Keep symbolic link method if possible (more secure)**

---

**Need the full deployment guide?** See `docs/DEPLOYMENT_AND_UPDATE_GUIDE.md`

**That should fix your image storage issue!** 🎉

