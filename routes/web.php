<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sitemap & Robots
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [\App\Http\Controllers\RobotsController::class, 'index'])->name('robots');

// About
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

// Currency Switcher
Route::get('/currency/{code}', [\App\Http\Controllers\CurrencyController::class, 'switch'])->name('currency.switch');

// Language Switcher
Route::get('/locale/{locale}', [\App\Http\Controllers\LocaleController::class, 'switch'])->name('locale.switch');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Destinations
Route::get('/destinations', [App\Http\Controllers\DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [App\Http\Controllers\DestinationController::class, 'show'])->name('destinations.show');

// Tours
Route::get('/tours', [App\Http\Controllers\TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{tour}', [App\Http\Controllers\TourController::class, 'show'])->name('tours.show');

// Contact
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'show'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// User Dashboard (for all authenticated users - clients and admins)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'userDashboard'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    // Wishlist Routes
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [\App\Http\Controllers\WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{tour}', [\App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/wishlist/check/{tour}', [\App\Http\Controllers\WishlistController::class, 'check'])->name('wishlist.check');
    
    // TODO: Add user bookings routes here
});

// Admin Panel (requires authentication and admin role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Destinations Management
    Route::resource('destinations', \App\Http\Controllers\Admin\DestinationController::class);
    
    // Tours Management
    Route::resource('tours', \App\Http\Controllers\Admin\TourController::class);
    
    // Announcements Management
    Route::resource('announcements', \App\Http\Controllers\Admin\AnnouncementController::class);
    
    // Discounts Management
    Route::resource('discounts', \App\Http\Controllers\Admin\DiscountController::class);
    
    // Users Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    
    // Contact Messages Management
    Route::resource('contact-messages', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::post('contact-messages/{contactMessage}/mark-replied', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsReplied'])->name('contact-messages.mark-replied');
    Route::post('contact-messages/{contactMessage}/archive', [\App\Http\Controllers\Admin\ContactMessageController::class, 'archive'])->name('contact-messages.archive');
    
    // Bookings Management
    // Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
});
