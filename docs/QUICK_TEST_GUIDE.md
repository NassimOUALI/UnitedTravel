# 🚀 Quick Test Guide - New Features

## Server Running: http://localhost:8000

---

## ✅ Test 1: Profile Page (2 minutes)

### Steps:
1. **Login**: `admin@example.com` / `password`
2. **Navigate**: Click "My Profile" in admin sidebar OR go to `/profile`
3. **Test Profile Tab**:
   - Change name to "Admin Test"
   - Click "Save Changes"
   - ✅ Verify success message
4. **Test Password Tab**:
   - Current password: `password`
   - New password: `password123`
   - Confirm: `password123`
   - Click "Update Password"
   - ✅ Verify success message
5. **Test Photo Tab**:
   - Upload any image
   - ✅ Verify preview appears
   - Click "Upload Photo"
   - ✅ Check topbar shows new photo

**Expected Result**: All tabs work, changes save successfully

---

## ✅ Test 2: New Admin Layout (3 minutes)

### Steps:
1. **Navigate**: `/admin/dashboard`
2. **Verify Sidebar**:
   - ✅ Blue gradient background
   - ✅ Logo and "Admin" text at top
   - ✅ All menu items visible
   - ✅ "Dashboard" is highlighted
3. **Test Navigation**:
   - Click "Destinations" → ✅ Page loads, "Destinations" highlighted
   - Click "Tours" → ✅ Page loads, "Tours" highlighted
   - Click "Users" → ✅ Page loads, "Users" highlighted
4. **Test Topbar**:
   - ✅ Page title shows correctly
   - ✅ User avatar/name displays
   - Click user menu → ✅ Dropdown works
   - ✅ "Logout" option present
5. **Test Footer**:
   - Scroll to bottom
   - ✅ Compact footer visible
   - ✅ Links work

**Expected Result**: Sidebar fixed, navigation works, no layout breaks

---

## ✅ Test 3: Admin CRUDs with New Layout (5 minutes)

### Destinations:
1. **Navigate**: `/admin/destinations`
2. ✅ Clean table layout
3. Click "Add New Destination"
4. ✅ Form in card layout
5. ✅ Help sidebar on right
6. Click "Cancel"
7. Click "Edit" on any destination
8. ✅ Edit form looks good

### Tours:
1. **Navigate**: `/admin/tours`
2. Click "Add New Tour"
3. ✅ Form layout clean
4. ✅ Help tips visible

### Announcements:
1. **Navigate**: `/admin/announcements`
2. ✅ Table displays correctly
3. Click "Add New Announcement"
4. ✅ Simple centered form

### Discounts:
1. **Navigate**: `/admin/discounts`
2. ✅ Clean layout
3. Click "Add New Discount"
4. ✅ Form works

### Users:
1. **Navigate**: `/admin/users`
2. ✅ User table with photos
3. Click "Add New User"
4. ✅ Form with photo upload

**Expected Result**: All CRUDs display correctly with new layout

---

## ✅ Test 4: Mobile Responsive (2 minutes)

### Steps:
1. Open browser DevTools (F12)
2. Toggle device toolbar (Ctrl+Shift+M)
3. Select "iPhone 12 Pro" or similar
4. **Navigate**: `/admin/dashboard`
5. ✅ Hamburger menu visible
6. Click hamburger
7. ✅ Sidebar slides in
8. Click outside sidebar
9. ✅ Sidebar slides out
10. **Navigate**: `/profile`
11. ✅ Tabs stack on mobile
12. ✅ Content readable

**Expected Result**: Fully functional on mobile

---

## ✅ Test 5: Dashboard Stats (1 minute)

### Steps:
1. **Navigate**: `/admin/dashboard`
2. **Verify Stats Cards**:
   - ✅ Total Destinations shows count
   - ✅ Total Tours shows count
   - ✅ Total Users shows count
   - ✅ Active Discounts shows count
3. **Verify Quick Actions**:
   - ✅ 6 buttons visible
   - Click "Add Destination"
   - ✅ Goes to create form
4. **Verify Content Lists**:
   - ✅ Recent announcements listed
   - ✅ Active discounts listed
   - ✅ Recent destinations listed
   - ✅ Recent tours listed

**Expected Result**: Dashboard shows live data, all links work

---

## 🎯 Quick Visual Checklist

### Profile Page:
- [ ] 3 tabs visible and clickable
- [ ] Current user info displays
- [ ] Profile photo shows (or initial)
- [ ] Forms validate correctly
- [ ] Success messages appear
- [ ] Sidebar with quick links

### Admin Layout:
- [ ] Sidebar fixed on left (260px)
- [ ] Blue gradient sidebar
- [ ] Active link highlighted with gold border
- [ ] Topbar sticky at top
- [ ] User dropdown menu works
- [ ] Footer at bottom
- [ ] No regular navbar
- [ ] No breadcrumbs (replaced with topbar title)

### All Admin Pages:
- [ ] Consistent header style
- [ ] Card-based layouts
- [ ] Proper spacing
- [ ] Icons throughout
- [ ] Success/error alerts
- [ ] No layout breaks

---

## 🐛 Common Issues & Fixes

### Issue: Profile photo not uploading
**Fix**: Run `php artisan storage:link`

### Issue: Sidebar not showing
**Fix**: Clear cache with `php artisan view:clear`

### Issue: Layout looks broken
**Fix**: Hard refresh browser (Ctrl+F5)

### Issue: 404 on profile page
**Fix**: Check routes with `php artisan route:list | findstr profile`

---

## ✅ Success Criteria

All tests pass if:
- ✅ Profile page fully functional
- ✅ Admin sidebar navigation works
- ✅ All admin CRUDs use new layout
- ✅ Mobile responsive
- ✅ No console errors
- ✅ No PHP errors
- ✅ Forms validate
- ✅ Images upload

---

## 🎉 Done Testing?

If all tests pass, you're ready to use the new features!

**Next**: Continue with testing guide in `TESTING_GUIDE.md` for comprehensive Phase 1 testing.

---

**Total Test Time**: ~15 minutes  
**Difficulty**: Easy  
**Prerequisites**: Server running, logged in as admin

