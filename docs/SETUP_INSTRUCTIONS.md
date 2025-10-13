# United Travels - Setup Instructions

## Overview
Your Laravel project has been successfully configured with a complete Blade template structure based on your HTML template. The database schema has been created with migrations and models.

## What Has Been Created

### 1. Database Structure
- **Migrations**: All database tables have been created in `database/migrations/`
  - users (with profile_photo)
  - roles
  - role_user (pivot table)
  - destinations
  - tours
  - tour_destination (pivot table)
  - discounts
  - announcements

- **Models**: All Eloquent models with relationships in `app/Models/`
  - User (with roles relationship)
  - Role (with users relationship)
  - Destination (with tours relationship)
  - Tour (with destinations and discount relationships)
  - Discount (with tours relationship)
  - Announcement

### 2. Blade Template Structure

#### Layouts
- `resources/views/layouts/app.blade.php` - Main layout with header, footer, and content sections

#### Components
- `resources/views/components/preloader.blade.php` - Loading animation
- `resources/views/components/header.blade.php` - Navigation header with authentication
- `resources/views/components/footer.blade.php` - Footer with links and contact info
- `resources/views/components/hero.blade.php` - Hero section component
- `resources/views/components/language-modal.blade.php` - Language selector modal
- `resources/views/components/currency-modal.blade.php` - Currency selector modal

#### Pages
- `resources/views/home.blade.php` - Homepage with featured destinations, tours, and announcements
- `resources/views/auth/login.blade.php` - Login page
- `resources/views/auth/register.blade.php` - Registration page
- `resources/views/dashboard.blade.php` - Admin dashboard

#### Controllers
- `app/Http/Controllers/HomeController.php` - Handles homepage
- `app/Http/Controllers/DashboardController.php` - Handles admin dashboard
- `app/Http/Controllers/Auth/LoginController.php` - Handles authentication
- `app/Http/Controllers/Auth/RegisterController.php` - Handles registration

#### Middleware
- `app/Http/Middleware/AdminMiddleware.php` - Protects admin routes

### 3. Routes
All routes are defined in `routes/web.php`:
- `/` - Homepage
- `/login` - Login page
- `/register` - Registration page
- `/logout` - Logout (POST)
- `/dashboard` - Admin dashboard (requires authentication and admin role)
- `/destinations` - Destinations listing
- `/tours` - Tours listing
- `/contact` - Contact page
- `/admin/*` - Admin management routes (CRUD for destinations, tours, announcements, discounts)

## Setup Steps

### 1. Database Configuration
Update your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=united_travels
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 2. Run Migrations
```bash
php artisan migrate
```

### 3. Create Admin User (Optional)
You can use Laravel Tinker to create an admin user:
```bash
php artisan tinker
```

Then run:
```php
$user = \App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@unitedtravels.com',
    'password' => bcrypt('password'),
]);

$adminRole = \App\Models\Role::firstOrCreate(['name' => 'admin']);
$user->roles()->attach($adminRole->id);
```

### 4. Asset Organization

#### Current Assets
The CSS and JS files are already in place at:
- `public/assets/css/`
- `public/assets/js/`

#### Missing Assets (You need to add these from your HTML template)
Create these directories and add the corresponding images:

```
public/assets/
├── img/
│   ├── logos/
│   │   ├── favicon.png
│   │   ├── logo.png
│   │   ├── logo@2x.png
│   │   ├── menu-logo.png
│   │   ├── menu-logo@2x.png
│   │   ├── footer-logo.png
│   │   └── footer-logo@2x.png
│   ├── hero/
│   │   ├── h1.jpg
│   │   ├── h2.jpg
│   │   ├── h3.jpg
│   │   └── (add more hero images)
│   ├── destinations/
│   │   ├── default.jpg (placeholder)
│   │   └── (add destination images)
│   ├── tours/
│   │   ├── default.jpg (placeholder)
│   │   └── (add tour images)
│   ├── flags/
│   │   ├── en.svg
│   │   ├── fr.svg
│   │   ├── es.svg
│   │   └── (add more flag icons)
│   ├── icons/
│   │   ├── i1.svg (App Store badge)
│   │   └── i2.svg (Google Play badge)
│   └── avatars/
│       └── (user avatars if needed)
└── media/
    └── v1.mp4 (hero video)
```

**Note**: You'll need to extract these images from your original HTML template folder and place them in the appropriate directories.

### 5. Seeding Sample Data (Optional)
Create seeders for sample data:

```bash
php artisan make:seeder DestinationSeeder
php artisan make:seeder TourSeeder
php artisan make:seeder AnnouncementSeeder
```

Then populate them with sample data and run:
```bash
php artisan db:seed
```

### 6. Start the Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` to see your site!

## Features Implemented

### User Features
- ✅ User registration and login
- ✅ View featured destinations
- ✅ View featured tours with pricing and discounts
- ✅ View announcements
- ✅ Responsive navigation with user menu

### Admin Features
- ✅ Admin dashboard with statistics
- ✅ Manage destinations (CRUD - routes defined, controllers need to be implemented)
- ✅ Manage tours (CRUD - routes defined, controllers need to be implemented)
- ✅ Manage announcements (CRUD - routes defined, controllers need to be implemented)
- ✅ Manage discounts (CRUD - routes defined, controllers need to be implemented)
- ✅ Manage users (CRUD - routes defined, controllers need to be implemented)

### Database Schema Features
- ✅ Many-to-many relationship between users and roles
- ✅ Many-to-many relationship between tours and destinations
- ✅ One-to-many relationship between discounts and tours
- ✅ Proper foreign key constraints
- ✅ Nullable fields where appropriate
- ✅ Boolean fields for visibility and pricing flags

## Next Steps

### 1. Create Admin CRUD Controllers
You'll need to implement the admin controllers for managing:
- Destinations (`app/Http/Controllers/Admin/DestinationController.php`)
- Tours (`app/Http/Controllers/Admin/TourController.php`)
- Announcements (`app/Http/Controllers/Admin/AnnouncementController.php`)
- Discounts (`app/Http/Controllers/Admin/DiscountController.php`)
- Users (`app/Http/Controllers/Admin/UserController.php`)

### 2. Create Views for CRUD Operations
Create Blade views for each resource:
- `resources/views/admin/destinations/` (index, create, edit)
- `resources/views/admin/tours/` (index, create, edit)
- `resources/views/admin/announcements/` (index, create, edit)
- `resources/views/admin/discounts/` (index, create, edit)
- `resources/views/admin/users/` (index, create, edit)

### 3. Add File Upload Functionality
Implement image upload for:
- User profile photos
- Destination images
- Tour images

Configure in `config/filesystems.php` and use Laravel's Storage facade.

### 4. Add Validation
Create Form Request classes for validation:
```bash
php artisan make:request StoreDestinationRequest
php artisan make:request StoreTourRequest
# etc.
```

### 5. Enhance Security
- Add CSRF protection (already included in forms)
- Implement rate limiting for login attempts
- Add email verification if needed

### 6. Optimize Performance
- Add caching for frequently accessed data
- Implement eager loading to prevent N+1 queries
- Add pagination for list views

## Assets Reference
All asset references in Blade files use Laravel's `asset()` helper:
- `{{ asset('assets/css/theme-1.min.css') }}`
- `{{ asset('assets/js/theme-1.min.js') }}`
- `{{ asset('assets/img/logos/logo.png') }}`

## Troubleshooting

### Issue: "Class not found" errors
Run:
```bash
composer dump-autoload
```

### Issue: Routes not working
Clear route cache:
```bash
php artisan route:clear
php artisan route:cache
```

### Issue: Views not updating
Clear view cache:
```bash
php artisan view:clear
```

### Issue: Assets not loading
Make sure you're running:
```bash
php artisan serve
```
And accessing via `http://localhost:8000` (not opening HTML files directly)

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Templates](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Authentication](https://laravel.com/docs/authentication)

## Support
For issues or questions, refer to the Laravel documentation or community forums.

---

**Project**: United Travels
**Framework**: Laravel 11.x
**Template**: Bootstrap-based Travel Agency Template
**Database**: MySQL/MariaDB

