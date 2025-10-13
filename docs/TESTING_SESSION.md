# 🚀 Testing Session - Phase 1

**Status:** Server Running at `http://localhost:8000`  
**Admin Login:** `admin@example.com` / `password`

---

## Quick Links

- 🏠 **Homepage:** http://localhost:8000
- 👨‍💼 **Admin Dashboard:** http://localhost:8000/admin/dashboard
- 🗺️ **Destinations (Public):** http://localhost:8000/destinations
- 🎫 **Tours (Public):** http://localhost:8000/tours

---

## 📋 Testing Session Workflow

### Session 1: Admin Dashboard & Navigation (5 min)
```
✅ Step 1: Login
   → Go to: http://localhost:8000/login
   → Email: admin@example.com
   → Password: password

✅ Step 2: Verify Dashboard
   → Go to: http://localhost:8000/admin/dashboard
   → Check all statistics display correctly
   → Verify 6 "Quick Actions" buttons are visible

✅ Step 3: Test Navigation
   → Click each Quick Action button
   → Verify you reach the correct page
   → Use browser back button to return
```

---

### Session 2: Destinations CRUD (10 min)
```
📍 Navigate to: http://localhost:8000/admin/destinations

✅ CREATE Test:
   1. Click "Add New Destination"
   2. Fill form:
      - Name: "Test Destination"
      - Location: "Test Country"
      - Description: "This is a test destination for validation"
      - Image: Upload any JPG/PNG
   3. Click "Create Destination"
   4. ✓ Check for green success message
   5. ✓ Verify destination appears in list

✅ EDIT Test:
   1. Click Edit button (pencil icon) on "Test Destination"
   2. Change name to: "Updated Test Destination"
   3. Click "Update Destination"
   4. ✓ Check for green success message
   5. ✓ Verify name updated in list

✅ DELETE Test:
   1. Click Delete button (trash icon) on "Updated Test Destination"
   2. Confirm deletion in popup
   3. ✓ Check for green success message
   4. ✓ Verify destination removed from list

✅ IMAGE Test:
   1. Create new destination
   2. Upload image
   3. Go to public destinations: http://localhost:8000/destinations
   4. ✓ Verify image displays correctly
```

---

### Session 3: Tours CRUD (15 min)
```
🎫 Navigate to: http://localhost:8000/admin/tours

✅ CREATE Test:
   1. Click "Add New Tour"
   2. Fill form:
      - Title: "Test Tour Package"
      - Description: "Complete test tour description"
      - Duration: "5 Days 4 Nights"
      - Price: 999.99
      - Check "Price is defined"
      - Start Date: [future date]
      - End Date: [future date after start]
      - Select at least 2 destinations
      - Image: Upload any JPG/PNG
   3. Click "Create Tour"
   4. ✓ Check for green success message

✅ EDIT Test:
   1. Click Edit on "Test Tour Package"
   2. Change title to: "Updated Tour Package"
   3. Change price to: 1299.99
   4. Add/remove destinations
   5. Click "Update Tour"
   6. ✓ Verify success message
   7. ✓ Check updated details in list

✅ DISCOUNT Test:
   1. Edit any tour
   2. Select a discount (e.g., "Early Bird Discount")
   3. Save tour
   4. Go to: http://localhost:8000/tours
   5. ✓ Verify discounted price shows
   6. ✓ Check discount badge displays

✅ DELETE Test:
   1. Delete "Updated Tour Package"
   2. ✓ Verify success message
```

---

### Session 4: Announcements CRUD (8 min)
```
📢 Navigate to: http://localhost:8000/admin/announcements

✅ CREATE Test:
   1. Click "Add New Announcement"
   2. Fill form:
      - Title: "Important Update"
      - Content: "This is a test announcement message"
      - Check "Visible on Homepage"
   3. Click "Create Announcement"
   4. ✓ Check success message

✅ VISIBILITY Test:
   1. Go to homepage: http://localhost:8000
   2. ✓ Verify announcement displays in hero section
   3. Return to admin/announcements
   4. Edit the announcement
   5. Uncheck "Visible on Homepage"
   6. Save changes
   7. Refresh homepage
   8. ✓ Verify announcement is hidden

✅ DELETE Test:
   1. Delete test announcement
   2. ✓ Verify success message
```

---

### Session 5: Discounts CRUD (10 min)
```
💰 Navigate to: http://localhost:8000/admin/discounts

✅ CREATE Test:
   1. Click "Add New Discount"
   2. Fill form:
      - Name: "Testing Promo"
      - Percentage: 30
      - Valid Until: [future date]
   3. Click "Create Discount"
   4. ✓ Check success message

✅ APPLY TO TOUR Test:
   1. Go to admin/tours
   2. Edit any tour
   3. Select "Testing Promo" discount
   4. Save tour
   5. Go to public tours page
   6. ✓ Verify:
      - Original price shown crossed out
      - Discounted price shown
      - "30% OFF" badge displays

✅ DELETION PROTECTION Test:
   1. Try to delete "Testing Promo"
   2. ✓ Verify error: "Cannot delete discount: It is currently applied"
   3. Remove discount from tour
   4. Try delete again
   5. ✓ Verify successful deletion

✅ EXPIRATION Test:
   1. Create discount with past date
   2. ✓ Verify validation error
```

---

### Session 6: Users CRUD (12 min)
```
👥 Navigate to: http://localhost:8000/admin/users

✅ CREATE Test:
   1. Click "Add New User"
   2. Fill form:
      - Name: "Test User"
      - Email: "testuser@example.com"
      - Password: "password123"
      - Confirm Password: "password123"
      - Check "Client" role
      - Upload profile photo (optional)
   3. Click "Create User"
   4. ✓ Check success message

✅ EDIT Test:
   1. Click Edit on "Test User"
   2. Change name to: "Updated Test User"
   3. Leave password blank (keep current)
   4. Change role from "Client" to "Admin"
   5. Click "Update User"
   6. ✓ Verify success message
   7. ✓ Check role badge updated

✅ PASSWORD CHANGE Test:
   1. Edit "Updated Test User"
   2. Enter new password: "newpassword123"
   3. Confirm password
   4. Save changes
   5. Logout
   6. Login with: testuser@example.com / newpassword123
   7. ✓ Verify login successful
   8. Logout and login back as admin

✅ SELF-DELETE PROTECTION Test:
   1. Try to delete your own account (admin@example.com)
   2. ✓ Verify error: "You cannot delete your own account"
   3. ✓ Check delete button is disabled

✅ DELETE Test:
   1. Delete "Updated Test User"
   2. ✓ Verify success message
```

---

## 🔥 Advanced Validation Testing (10 min)

### Image Upload Validation
```
Test at: Any CRUD that accepts images

❌ INVALID Tests (Should Fail):
   - Upload .txt file → ✓ Verify error
   - Upload .pdf file → ✓ Verify error
   - Upload 10MB+ file → ✓ Verify error

✅ VALID Tests (Should Pass):
   - Upload .jpg file → ✓ Success
   - Upload .png file → ✓ Success
   - Upload .gif file → ✓ Success
```

### Form Validation
```
Test at: Any create/edit form

❌ Empty Required Fields:
   - Leave name empty → ✓ Verify error
   - Leave email empty → ✓ Verify error
   - Leave password empty (on create) → ✓ Verify error

❌ Invalid Email:
   - Enter "notanemail" → ✓ Verify error
   - Enter "test@" → ✓ Verify error

❌ Duplicate Email (Users):
   - Try creating user with existing email → ✓ Verify error

❌ Password Rules:
   - Enter "123" (too short) → ✓ Verify error
   - Password mismatch → ✓ Verify error

❌ Discount Validation:
   - Percentage: 150 → ✓ Verify error (max 100)
   - Percentage: 0 → ✓ Verify error (min 1)
   - Valid Until: Past date → ✓ Verify error
```

---

## 📊 Pagination Testing (5 min)

```
Test at: Admin destinations, tours, announcements, discounts, users

1. Note current count
2. Add items until total > 10
3. ✓ Verify pagination appears
4. ✓ Click "Next" button works
5. ✓ Click page numbers work
6. ✓ Click "Previous" button works
```

---

## 🎯 Public Pages Testing (10 min)

### Homepage
```
✅ Hero Section:
   - ✓ Carousel auto-advances
   - ✓ Prev/Next buttons work
   - ✓ Indicators work
   - ✓ Search form submits

✅ Featured Destinations:
   - ✓ Shows 6 destinations
   - ✓ Images load correctly
   - ✓ Click destination → goes to detail page

✅ Featured Tours:
   - ✓ Shows 3 tours
   - ✓ Discounted prices show correctly
   - ✓ Click tour → goes to detail page

✅ Announcements:
   - ✓ Only visible announcements show
   - ✓ Content displays correctly
```

### Destinations Page
```
Navigate to: http://localhost:8000/destinations

✅ Search:
   - Enter keyword → ✓ Filters results
   - Select location → ✓ Filters by location
   - Clear filters → ✓ Shows all

✅ Grid:
   - ✓ Masonry layout displays
   - ✓ Images load correctly
   - ✓ Tour count badge shows
   - ✓ Hover effects work

✅ Detail Page:
   - Click any destination
   - ✓ Hero image displays
   - ✓ Description shows
   - ✓ Related tours list
```

### Tours Page
```
Navigate to: http://localhost:8000/tours

✅ Search:
   - Enter keyword → ✓ Filters results
   - Select location → ✓ Filters results

✅ Cards:
   - ✓ Images load correctly
   - ✓ Prices display
   - ✓ Discount badges show
   - ✓ Duration shows

✅ Detail Page:
   - Click any tour
   - ✓ All details display
   - ✓ Destinations list shows
   - ✓ Pricing correct
```

---

## ✅ Final Checklist

Before marking Phase 1 complete:

- [ ] All Admin CRUDs working (Destinations, Tours, Announcements, Discounts, Users)
- [ ] Image uploads working correctly
- [ ] Form validation working on all forms
- [ ] Pagination working on all lists
- [ ] Public pages display correctly
- [ ] Search/filtering working
- [ ] No console errors in browser
- [ ] No PHP errors in terminal
- [ ] Database seeded data displays correctly
- [ ] Authentication working (login/logout/register)

---

## 🐛 Issues Found?

Document any bugs using this template:

```
**Bug:** [Short description]
**Page:** [URL where bug occurs]
**Steps to Reproduce:**
1. 
2. 
3. 

**Expected:** [What should happen]
**Actual:** [What actually happened]
**Error Message:** [If any]
```

---

## ✅ All Tests Passed?

**Congratulations! Phase 1 is complete! 🎉**

**Total Testing Time:** ~90 minutes

**Next Steps:**
- Mark all items complete in DEVELOPMENT_PLAN.md
- Ready to proceed to Phase 2: Bookings & Payments

---

**Tips for Efficient Testing:**
- Open browser DevTools (F12) to check for console errors
- Keep terminal visible to watch for PHP errors
- Use multiple browser tabs for quick switching
- Take screenshots of any issues found

