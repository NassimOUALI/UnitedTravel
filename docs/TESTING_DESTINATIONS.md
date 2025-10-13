# Testing the Destinations Feature 🧪

## Quick Start Test Guide

### Prerequisites
1. Ensure your Laravel server is running:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

2. Login credentials:
   - **Admin**: `admin@example.com` / `password`
   - **Client**: `client@example.com` / `password`

---

## Test Scenarios

### 1️⃣ Public Browsing (No Login Required)

#### Test: View All Destinations
1. **Navigate to**: `http://localhost:8000/destinations`
2. **Expected**:
   - Grid layout of destination cards
   - Each card shows: image, name, location, description snippet
   - Search/filter functionality
   - Pagination if more than 12 destinations

#### Test: View Single Destination
1. **Navigate to**: `http://localhost:8000/destinations/1` (or click any destination)
2. **Expected**:
   - Full destination details
   - Large hero image
   - Complete description
   - Associated tours listed below
   - "Book Now" or "View Tours" buttons

---

### 2️⃣ Admin CRUD Operations (Login as Admin)

#### Test: View All Destinations (Admin)
1. **Login** as admin
2. **Navigate to**: Admin Panel → Destinations
   - Direct URL: `http://localhost:8000/admin/destinations`
3. **Expected**:
   - Table view of all destinations
   - Columns: Image thumbnail, Name, Location, Tours count, Created date, Actions
   - Edit and Delete buttons for each destination
   - "Add New Destination" button at top
   - Success message if just created/updated/deleted
   - Pagination

#### Test: Create New Destination
1. **Navigate to**: `http://localhost:8000/admin/destinations/create`
2. **Fill the form**:
   ```
   Name: Test Destination
   Location: Test Country
   Description: This is a test destination with amazing views and culture.
   Image: [Upload any JPEG/PNG, recommended 1200x800px, max 2MB]
   ```
3. **Click**: "Create Destination"
4. **Expected**:
   - Redirected to destinations list
   - Green success message: "Destination created successfully!"
   - New destination appears in the list
   - Image displays as thumbnail

#### Test: Image Preview on Upload
1. **Navigate to**: Create or Edit form
2. **Click**: "Choose File" for image
3. **Select**: Any valid image
4. **Expected**:
   - Image preview appears below the upload field
   - Shows "Preview:" label with thumbnail

#### Test: Edit Existing Destination
1. **Navigate to**: Destinations list
2. **Click**: Edit icon (pencil) on any destination
3. **Modify**: Change name or description
4. **Optionally**: Upload new image (will replace old one)
5. **Click**: "Update Destination"
6. **Expected**:
   - Redirected to destinations list
   - Success message: "Destination updated successfully!"
   - Changes reflected in list
   - If new image uploaded, old image is deleted

#### Test: Delete Destination
1. **Navigate to**: Destinations list
2. **Click**: Delete icon (trash) on any destination
3. **Confirm**: Click OK on confirmation dialog
4. **Expected**:
   - Redirected to destinations list
   - Success message: "Destination deleted successfully!"
   - Destination removed from list
   - Image file deleted from storage

---

### 3️⃣ Validation Tests

#### Test: Empty Fields
1. **Navigate to**: Create destination form
2. **Leave all fields empty**
3. **Click**: "Create Destination"
4. **Expected**:
   - Form does NOT submit
   - Red error messages appear below required fields:
     - "The destination name is required."
     - "The description is required."
     - "The location is required."

#### Test: Invalid Image Format
1. **Navigate to**: Create destination form
2. **Fill**: Name, Location, Description
3. **Upload**: A PDF or TXT file
4. **Click**: "Create Destination"
5. **Expected**:
   - Error message: "The image must be a file of type: jpeg, png, jpg, webp."

#### Test: Oversized Image
1. **Navigate to**: Create destination form
2. **Fill**: Name, Location, Description
3. **Upload**: An image larger than 2MB
4. **Click**: "Create Destination"
5. **Expected**:
   - Error message: "The image size cannot exceed 2MB."

#### Test: Max Length
1. **Navigate to**: Create destination form
2. **Fill**: Name with 200 characters (more than 150 max)
3. **Click**: "Create Destination"
4. **Expected**:
   - Error message: "The destination name cannot exceed 150 characters."

---

### 4️⃣ Image Storage Tests

#### Test: Image Uploaded to Correct Location
1. **Create** a destination with image
2. **Check**: `storage/app/public/destinations/` directory
3. **Expected**:
   - New image file exists
   - Filename format: `timestamp_originalname.ext`

#### Test: Image Accessible via Public URL
1. **Create** a destination with image
2. **Copy** the image path from database or view source
3. **Navigate to**: `http://localhost:8000/storage/destinations/[filename]`
4. **Expected**:
   - Image displays in browser

#### Test: Old Image Deleted on Update
1. **Create** destination with Image A
2. **Note** the filename from storage directory
3. **Edit** destination and upload Image B
4. **Update**
5. **Check**: `storage/app/public/destinations/` directory
6. **Expected**:
   - Image A is deleted
   - Only Image B remains

#### Test: Image Deleted with Destination
1. **Create** destination with image
2. **Note** the filename
3. **Delete** the destination
4. **Check**: `storage/app/public/destinations/` directory
5. **Expected**:
   - Image file is deleted

---

### 5️⃣ Permission Tests

#### Test: Guest Access to Admin Routes
1. **Logout** (or open incognito window)
2. **Navigate to**: `http://localhost:8000/admin/destinations`
3. **Expected**:
   - Redirected to login page
   - Cannot access admin CRUD pages

#### Test: Client Role Access to Admin Routes
1. **Login** as client (`client@example.com` / `password`)
2. **Navigate to**: `http://localhost:8000/admin/destinations`
3. **Expected**:
   - Access denied (403) or redirect
   - Cannot access admin CRUD pages

#### Test: Admin Access to Admin Routes
1. **Login** as admin (`admin@example.com` / `password`)
2. **Navigate to**: `http://localhost:8000/admin/destinations`
3. **Expected**:
   - Full access to all CRUD operations

---

### 6️⃣ Integration Tests

#### Test: Admin Dashboard Quick Links
1. **Login** as admin
2. **Navigate to**: `http://localhost:8000/admin/dashboard`
3. **Check**:
   - "Add Destination" button in Quick Actions
   - "Recent Destinations" section shows latest destinations
   - Each destination has edit/delete buttons
   - "View All" link goes to destinations index
4. **Expected**: All links work correctly

#### Test: Destination-Tour Relationship
1. **Navigate to**: Public destination details page
2. **Expected**:
   - Associated tours are listed
   - Each tour shows: title, price, duration
   - Can click to view tour details

---

## Automated Testing Checklist

If you want to write automated tests, here are the key test cases:

### Feature Tests
```php
// tests/Feature/Admin/DestinationTest.php
- test_admin_can_view_destinations_list()
- test_admin_can_create_destination()
- test_admin_can_create_destination_with_image()
- test_admin_can_update_destination()
- test_admin_can_delete_destination()
- test_guest_cannot_access_admin_destinations()
- test_client_cannot_access_admin_destinations()
- test_validation_errors_are_shown()

// tests/Feature/DestinationTest.php
- test_anyone_can_view_destinations_list()
- test_anyone_can_view_single_destination()
- test_destinations_are_paginated()
```

### Unit Tests
```php
// tests/Unit/DestinationTest.php
- test_destination_has_tours_relationship()
- test_destination_casts_are_correct()
```

---

## Common Issues During Testing

### Issue: Images Not Showing
**Solution**:
```bash
php artisan storage:link
php artisan cache:clear
```

### Issue: Permission Denied
**Solution**:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Issue: Upload Fails
**Solution**: Check `php.ini`
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

### Issue: Routes Not Found
**Solution**:
```bash
php artisan route:clear
php artisan route:cache
```

---

## Success Criteria ✅

The Destinations feature is working correctly if:

- ✅ Public users can browse and view all destinations
- ✅ Admins can create, read, update, and delete destinations
- ✅ Images upload successfully and display correctly
- ✅ Old images are deleted when updated or destination is deleted
- ✅ Validation prevents invalid data
- ✅ Non-admin users cannot access admin CRUD pages
- ✅ All links in admin dashboard work
- ✅ Destinations show associated tours

---

## Next Test: Tours Feature

Once Destinations testing is complete, move on to implementing and testing the Tours CRUD feature (similar structure).

