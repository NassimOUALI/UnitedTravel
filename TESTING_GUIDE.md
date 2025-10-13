# 🧪 Phase 1 Testing Guide

**Quick Start:** `http://localhost:8000/admin/dashboard`  
**Login:** `admin@example.com` / `password`

---

## ✅ Testing Checklist

### 1. Admin Dashboard Access ✅
- [ ] Navigate to `/admin/dashboard`
- [ ] Verify all statistics display
- [ ] Check "Quick Actions" buttons work
- [ ] Verify "View All" links work

---

### 2. Destinations CRUD ✅
**Create:**
- [ ] Click "Add Destination"
- [ ] Fill in name, location, description
- [ ] Upload image
- [ ] Click "Create"
- [ ] Verify success message

**Edit:**
- [ ] Click Edit button on a destination
- [ ] Modify details
- [ ] Change image
- [ ] Click "Update"
- [ ] Verify success message

**Delete:**
- [ ] Click Delete button
- [ ] Confirm deletion
- [ ] Verify success message

---

### 3. Tours CRUD ✅
**Create:**
- [ ] Click "Add Tour"
- [ ] Fill in all fields
- [ ] Select destination(s)
- [ ] Select discount (optional)
- [ ] Upload image
- [ ] Click "Create"
- [ ] Verify success message

**Edit:**
- [ ] Click Edit button on a tour
- [ ] Modify details
- [ ] Change destinations
- [ ] Change discount
- [ ] Click "Update"
- [ ] Verify success message

**Delete:**
- [ ] Click Delete button
- [ ] Confirm deletion
- [ ] Verify success message

---

### 4. Announcements CRUD ✨
**Create:**
- [ ] Click "Add Announcement"
- [ ] Enter title and content
- [ ] Toggle visibility ON
- [ ] Click "Create"
- [ ] Go to homepage
- [ ] Verify announcement shows

**Edit:**
- [ ] Click Edit button
- [ ] Modify content
- [ ] Toggle visibility OFF
- [ ] Click "Update"
- [ ] Go to homepage
- [ ] Verify announcement hidden

**Delete:**
- [ ] Click Delete button
- [ ] Confirm deletion
- [ ] Verify success message

---

### 5. Discounts CRUD ✨
**Create:**
- [ ] Click "Add Discount"
- [ ] Enter name: "Test Discount"
- [ ] Enter percentage: 25
- [ ] Select future date
- [ ] Click "Create"
- [ ] Verify success message

**Apply to Tour:**
- [ ] Edit any tour
- [ ] Select the discount
- [ ] Save tour
- [ ] View tour on public page
- [ ] Verify discounted price shows

**Try Delete (With Tours):**
- [ ] Try to delete discount
- [ ] Verify error message
- [ ] Remove discount from all tours
- [ ] Delete discount successfully

---

### 6. Users CRUD ✨ **NEW**
**Create:**
- [ ] Click "Add User"
- [ ] Enter name, email, password
- [ ] Check "Admin" role
- [ ] Click "Create"
- [ ] Verify success message

**Edit:**
- [ ] Click Edit button
- [ ] Change name
- [ ] Leave password blank (keep current)
- [ ] Change roles
- [ ] Click "Update"
- [ ] Verify success message

**Edit Password:**
- [ ] Edit a user
- [ ] Enter new password
- [ ] Confirm password
- [ ] Click "Update"
- [ ] Logout and login with new password

**Try Delete Self:**
- [ ] Try to delete your own account
- [ ] Verify error message
- [ ] Confirm prevention works

**Delete Other User:**
- [ ] Delete a different user
- [ ] Confirm deletion
- [ ] Verify success message

---

## 🔥 Advanced Testing

### Image Upload
- [ ] Upload JPG image
- [ ] Upload PNG image
- [ ] Try uploading non-image file (should fail)
- [ ] Verify old images deleted on update

### Validation
- [ ] Try empty required fields
- [ ] Try invalid email format
- [ ] Try duplicate email
- [ ] Try password less than 8 characters
- [ ] Try discount percentage > 100
- [ ] Try past date for discount

### Pagination
- [ ] Add 20+ destinations
- [ ] Verify pagination appears
- [ ] Navigate through pages
- [ ] Repeat for tours, announcements, discounts, users

---

## 🐛 Bug Reporting Template

If you find any issues:

```
**Bug Title:** Brief description
**Steps to Reproduce:**
1. Step one
2. Step two
3. Step three

**Expected:** What should happen
**Actual:** What actually happened
**Screenshot:** (if applicable)
```

---

## ✅ All Tests Passed?

If everything works, Phase 1 is complete! 🎉

**Next:** Ready for Phase 2 (Public Pages)!

