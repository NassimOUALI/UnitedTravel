# Dashboard Architecture - United Travels

## 📊 Two-Dashboard System

The application now implements a **two-dashboard architecture** for better user experience and separation of concerns.

---

## 🎯 Dashboard 1: User Dashboard

**Route**: `/dashboard`  
**Access**: ALL authenticated users (admin + client)  
**Controller**: `DashboardController@userDashboard`  
**View**: `resources/views/user/dashboard.blade.php`

### Purpose
Personal dashboard for users to manage their travel experience.

### Features
- ✅ View upcoming bookings
- ✅ View past bookings  
- ✅ Booking history
- ✅ Profile summary
- ✅ Wishlist count
- ✅ Quick actions (browse tours, view bookings, edit profile)
- ✅ **Link to Admin Panel** (only visible for admins)

### Data Displayed
```php
- $user // Current user info
- $bookings // All user's bookings
- $upcomingBookings // Future bookings
- $pastBookings // Completed bookings
- $wishlistCount // Number of saved tours
```

### Navigation
```
Header Menu → My Dashboard
└── Shows user's personal dashboard
    └── If admin: Shows "Admin Panel" button
```

---

## 🔧 Dashboard 2: Admin Panel

**Route**: `/admin/dashboard`  
**Access**: Admins ONLY (requires `admin` role)  
**Controller**: `Admin\AdminDashboardController@index`  
**View**: `resources/views/admin/dashboard.blade.php`

### Purpose
Content management and system administration.

### Features
- ✅ Site statistics (destinations, tours, users, announcements)
- ✅ Quick actions (add destination, tour, announcement, discount)
- ✅ Recent destinations with edit/delete
- ✅ Recent tours with edit/delete
- ✅ Active announcements with edit/delete
- ✅ Active discounts with edit/delete
- ✅ **CRUD management** for all content types

### Data Displayed
```php
- $stats[] // Count of destinations, tours, users, announcements
- $recentDestinations // Latest 5 destinations
- $recentTours // Latest 5 tours with discounts
- $recentAnnouncements // Latest 5 visible announcements
- $recentDiscounts // Latest 5 discounts
```

### Navigation
```
Header Menu → My Dashboard → Admin Panel
└── Shows content management interface
    └── Access to all CRUD operations
```

---

## 🔀 User Flow

### For Regular Clients
1. Login → Redirected to `/dashboard` (User Dashboard)
2. See: My bookings, profile, wishlist
3. Can: Browse tours, view bookings, edit profile
4. **Cannot** see: Admin Panel option

### For Admins
1. Login → Redirected to `/admin/dashboard` (Admin Panel)
2. From User Dashboard: Click "Admin Panel" button
3. From Header Menu: Select "Admin Panel"
4. Can: Manage all content, view statistics, CRUD operations
5. Can also: Access user dashboard for personal bookings

---

## 🗺️ Route Structure

```php
// User Dashboard (all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])
        ->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    // Bookings, wishlist routes...
});

// Admin Panel (admin role required)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');
    Route::resource('destinations', DestinationController::class);
    Route::resource('tours', TourController::class);
    // Other admin CRUD routes...
});
```

---

## 📱 Header Navigation Menu

### Guest Users
```
- Home
- Destinations
- Tours
- About
- Contact
[Login] [Register]
```

### Authenticated Clients
```
- Home
- Destinations  
- Tours
- About
- Contact
[User Avatar] ▼
  - My Dashboard
  - Profile
  - My Wishlist
  - My Bookings
  - Logout
```

### Authenticated Admins
```
- Home
- Destinations
- Tours
- About
- Contact
[User Avatar] ▼
  - My Dashboard      ← Personal dashboard
  - Admin Panel       ← Content management
  - Profile
  - My Wishlist
  - My Bookings
  - Logout
```

---

## 🎨 Visual Differences

### User Dashboard
- **Color Theme**: Friendly blues and greens
- **Cards**: Booking counts, upcoming tours
- **CTAs**: "Browse Tours", "View Bookings"
- **Tone**: Personal and welcoming

### Admin Panel
- **Color Theme**: Professional grays and accent colors
- **Cards**: System statistics, content counts
- **CTAs**: "Add Destination", "Add Tour"
- **Tone**: Administrative and efficient

---

## 🔐 Security

### Middleware Protection
```php
// User Dashboard - requires authentication
Route::middleware(['auth'])

// Admin Panel - requires authentication + admin role
Route::middleware(['auth', 'admin'])
```

### AdminMiddleware
```php
public function handle(Request $request, Closure $next)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (!Auth::user()->roles->contains('name', 'admin')) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
```

---

## 📁 File Structure

```
app/Http/Controllers/
├── DashboardController.php                # User dashboard
└── Admin/
    └── AdminDashboardController.php       # Admin panel

resources/views/
├── user/
│   ├── dashboard.blade.php                # User dashboard view
│   └── profile.blade.php                  # Profile edit
└── admin/
    ├── dashboard.blade.php                # Admin panel view
    ├── destinations/                      # Destination CRUD views
    ├── tours/                             # Tour CRUD views
    ├── announcements/                     # Announcement CRUD views
    └── discounts/                         # Discount CRUD views
```

---

## 🚀 Future Enhancements

### User Dashboard
- [ ] Booking calendar view
- [ ] Download invoices
- [ ] Review submitted tours
- [ ] Travel recommendations
- [ ] Points/loyalty program

### Admin Panel
- [ ] Advanced analytics
- [ ] Revenue reports
- [ ] User activity logs
- [ ] Bulk operations
- [ ] Export data to CSV/Excel

---

## 🧪 Testing Checklist

### User Dashboard
- [ ] Client can access `/dashboard`
- [ ] Client sees their bookings
- [ ] Client can edit profile
- [ ] Client **cannot** see admin panel link
- [ ] Redirected after login

### Admin Panel
- [ ] Admin can access `/admin/dashboard`
- [ ] Admin sees site statistics
- [ ] Admin can create/edit/delete content
- [ ] Client **cannot** access `/admin/dashboard` (403 error)
- [ ] Admin redirected to admin panel after login

---

## 💡 Key Benefits

### Separation of Concerns
✅ Personal data separate from admin functions  
✅ Cleaner UI - users don't see admin tools  
✅ Better UX - each dashboard serves specific purpose

### Security
✅ Role-based access control  
✅ Middleware protection  
✅ Separate routes and controllers

### Scalability
✅ Easy to add features to each dashboard  
✅ Can implement different layouts  
✅ Can add more user types/dashboards later

---

## 📋 Quick Reference

| Feature | User Dashboard | Admin Panel |
|---------|---------------|-------------|
| **Route** | `/dashboard` | `/admin/dashboard` |
| **Access** | All authenticated users | Admins only |
| **Purpose** | Personal account management | Site content management |
| **Shows** | Bookings, profile, wishlist | Statistics, CRUD operations |
| **Navigation** | Browse tours, view bookings | Manage content, view reports |

---

**Architecture Updated**: October 12, 2025  
**Status**: Implemented ✅

