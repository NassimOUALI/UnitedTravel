# Storage Path Update Summary

## Changes Made

All image storage has been updated to store files directly in `public_html/public/storage/` and display them with `/public/` prefix in URLs.

---

## 1. Filesystem Configuration Updated

**File:** `config/filesystems.php`

Added new `public_direct` disk that stores files in `public/storage` instead of `storage/app/public`:

```php
'public_direct' => [
    'driver' => 'local',
    'root' => public_path('storage'),
    'url' => env('APP_URL').'/public/storage',
    'visibility' => 'public',
    'throw' => false,
    'report' => false,
],
```

---

## 2. Controllers Updated

All controllers now use `'public_direct'` disk instead of `'public'`:

### **app/Http/Controllers/Admin/TourController.php**
- ✅ Image upload (create): Line 61 - `storeAs('tours', $filename, 'public_direct')`
- ✅ Image upload (update): Line 189 - `storeAs('tours', $filename, 'public_direct')`
- ✅ Attachment upload (create): Line 89 - `storeAs('tour-attachments', $filename, 'public_direct')`
- ✅ Attachment upload (update): Line 241 - `storeAs('tour-attachments', $filename, 'public_direct')`
- ✅ Image deletion (update): Line 156 - `Storage::disk('public_direct')->delete(...)`
- ✅ Attachment deletion (update): Line 221 - `Storage::disk('public_direct')->delete(...)`
- ✅ All file deletion (destroy): Lines 271, 279, 287 - `Storage::disk('public_direct')->delete(...)`

### **app/Http/Controllers/Admin/DestinationController.php**
- ✅ Image upload (create): Line 53 - `storeAs('destinations', $filename, 'public_direct')`
- ✅ Image upload (update): Line 141 - `storeAs('destinations', $filename, 'public_direct')`
- ✅ Image deletion (update): Line 108 - `Storage::disk('public_direct')->delete(...)`
- ✅ All file deletion (destroy): Lines 175, 182 - `Storage::disk('public_direct')->delete(...)`

### **app/Http/Controllers/ProfileController.php**
- ✅ Profile photo upload: Line 112 - `store('profile_photos', 'public_direct')`
- ✅ Profile photo deletion (remove): Line 66 - `Storage::disk('public_direct')->delete(...)`
- ✅ Profile photo deletion (replace): Line 108 - `Storage::disk('public_direct')->delete(...)`

---

## 3. Views Updated

All views now include `/public/` prefix when displaying admin-uploaded images:

### **Tour & Destination Images (from images table)**

- ✅ `resources/views/tours/show.blade.php`
  - Line 22: Hero image - `asset('public/' . $headerImage)`
  - Line 258: Attachment download - `asset('public/' . $attachment->path)`
  - Line 416: Related tour images - `asset('public/' . $related->image_path)`

- ✅ `resources/views/destinations/show.blade.php`
  - Line 22: Hero image - `asset('public/' . $headerImage)`

- ✅ `resources/views/admin/tours/_form.blade.php`
  - Line 170: Existing images - `asset('public/' . $image->path)`
  - Line 258: Attachments - `asset('public/' . $attachment->path)`

- ✅ `resources/views/admin/destinations/_form.blade.php`
  - Line 91: Existing images - `asset('public/' . $image->path)`

- ✅ `resources/views/admin/dashboard.blade.php`
  - Line 359: Recent destinations - `asset('public/' . $destination->image_path)`
  - Line 418: Recent tours - `asset('public/' . $tour->image_path)`

- ✅ `resources/views/components/image-gallery.blade.php`
  - Line 17: Main carousel image - `asset('public/' . $image->path)`
  - Line 54: Thumbnails - `asset('public/' . $image->path)`

- ✅ `resources/views/components/image-carousel.blade.php`
  - Line 30: Carousel images - `asset('public/' . $image->path)`

- ✅ `resources/views/wishlist/index.blade.php`
  - Line 79: Tour images - `asset('public/' . $tour->image_path)`

### **Profile Photos**

- ✅ `resources/views/components/header.blade.php`
  - Line 101: User avatar (dropdown) - `asset('public/storage/' . auth()->user()->profile_photo)`
  - Line 112: User avatar (menu) - `asset('public/storage/' . auth()->user()->profile_photo)`

- ✅ `resources/views/layouts/admin.blade.php`
  - Line 399: Admin user avatar - `asset('public/storage/' . auth()->user()->profile_photo)`

- ✅ `resources/views/admin/users/index.blade.php`
  - Line 108: User list avatars - `asset('public/storage/' . $user->profile_photo)`

- ✅ `resources/views/user/dashboard.blade.php`
  - Line 180: Profile photo - `asset('public/storage/' . $user->profile_photo)`

- ✅ `resources/views/user/profile.blade.php`
  - Line 39: Profile photo (sidebar) - `asset('public/storage/' . $user->profile_photo)`
  - Line 312: Profile photo (edit form) - `asset('public/storage/' . $user->profile_photo)`

---

## 4. How It Works Now

### **Physical Storage:**
- Tour images: `public_html/public/storage/tours/`
- Destination images: `public_html/public/storage/destinations/`
- Tour attachments: `public_html/public/storage/tour-attachments/`
- Profile photos: `public_html/public/storage/profile_photos/`

### **Database Paths:**
- Tours/Destinations: `storage/tours/filename.jpg`
- Attachments: `storage/tour-attachments/file.pdf`
- Profile photos: `profile_photos/filename.jpg`

### **URL Paths:**
- Tours/Destinations: `https://unitedtravel.ma/public/storage/tours/filename.jpg`
- Profile photos: `https://unitedtravel.ma/public/storage/profile_photos/filename.jpg`

---

## 5. What You Need to Do on Production

1. **Create storage directories** (if they don't exist):
```bash
mkdir -p public_html/public/storage/tours
mkdir -p public_html/public/storage/destinations
mkdir -p public_html/public/storage/tour-attachments
mkdir -p public_html/public/storage/profile_photos
```

2. **Set proper permissions**:
```bash
chmod -R 755 public_html/public/storage
```

3. **Upload the updated files** via cPanel File Manager or FTP

4. **Clear Laravel cache** (if possible via SSH):
```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

---

## 6. Testing

After deployment, test:

1. ✅ Upload a new tour image → Should save to `public/storage/tours/`
2. ✅ Upload a new destination image → Should save to `public/storage/destinations/`
3. ✅ Upload a profile photo → Should save to `public/storage/profile_photos/`
4. ✅ View tour page → Images should display correctly
5. ✅ View destination page → Images should display correctly
6. ✅ Check profile → Profile photo should display correctly

**Expected URL format:**
```
https://unitedtravel.ma/public/storage/tours/1234567890_0_image.jpg
```

---

## Summary

✅ **Filesystem config**: Added `public_direct` disk  
✅ **3 Controllers**: Updated to use `public_direct`  
✅ **14 View files**: Updated to use `/public/` prefix  
✅ **All image types**: Tours, Destinations, Attachments, Profile Photos  

**Result**: No symlink needed! Images stored directly in accessible location with correct `/public/` URL prefix.

