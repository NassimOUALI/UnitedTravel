# 🌍 United Travels - Tour & Travel Management System

A comprehensive web application for managing tours, destinations, and travel bookings built with Laravel 11 and modern web technologies.

![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## ✨ Features

### For Users
- 🗺️ **Browse Tours & Destinations** - Explore amazing travel packages and destinations
- ❤️ **Wishlist System** - Save favorite tours for later
- 💱 **Multi-Currency Support** - View prices in USD, EUR, GBP, and more
- 🌐 **Multi-Language Support** - Available in English, French, Spanish, German, Italian, and Dutch
- 📱 **Responsive Design** - Perfect experience on all devices
- 📧 **Contact System** - Easy communication with the travel agency
- 👤 **User Dashboard** - Manage profile and view wishlisted tours
- 🔍 **Advanced Search & Filters** - Find the perfect tour quickly

### For Administrators
- 📊 **Admin Dashboard** - Comprehensive overview of the system
- 🎯 **Tour Management** - Create, edit, and manage tour packages
- 🗺️ **Destination Management** - Manage travel destinations
- 👥 **User Management** - Manage customers and administrators
- 💰 **Discount System** - Create and manage promotional discounts
- 📢 **Announcements** - Broadcast important messages to users
- 📩 **Contact Messages** - View and respond to customer inquiries
- 📸 **Image Gallery** - Multiple images per tour/destination
- 📎 **Attachments** - Upload tour documents and brochures

## 🚀 Quick Start

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 5.7+ or MariaDB
- Node.js & NPM
- Apache/Nginx web server

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/NassimOUALI/UnitedTravel.git
   cd UnitedTravel
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your `.env` file:**
   - Set database credentials
   - Configure mail settings
   - Update APP_URL
   - **IMPORTANT:** Set root admin credentials (required):
     ```env
     ROOT_ADMIN_NAME="Your Name"
     ROOT_ADMIN_EMAIL=your-email@example.com
     ROOT_ADMIN_PASSWORD=your-secure-password-here
     ```

5. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```
   
   ⚠️ **Important:** The seeder will fail if `ROOT_ADMIN_EMAIL` and `ROOT_ADMIN_PASSWORD` are not set in your `.env` file!

6. **Build assets:**
   ```bash
   npm run build
   ```

7. **Start the development server:**
   ```bash
   php artisan serve
   ```

8. **Access the application:**
   - Frontend: http://localhost:8000
   - Admin Panel: http://localhost:8000/admin/dashboard

### 🔐 Admin Credentials

**Root Admin:** Use the credentials you set in your `.env` file:
- Email: Value of `ROOT_ADMIN_EMAIL`
- Password: Value of `ROOT_ADMIN_PASSWORD`

**Demo Users:** (Only created if `SEED_DEMO_USERS=true`)
- **Client 1:** client@example.com / password
- **Client 2:** jane@example.com / password

⚠️ **Note:** Demo users are disabled by default and should NOT be enabled in production!

## 🔒 Security

**IMPORTANT**: Please read [SECURITY.md](SECURITY.md) before deploying to production!

Key security steps:
1. ✅ Never commit `.env` file
2. ✅ Change default demo user credentials
3. ✅ Generate new APP_KEY
4. ✅ Use strong database passwords
5. ✅ Enable HTTPS in production
6. ✅ Set APP_DEBUG=false in production

## 📁 Project Structure

```
UnitedTravels/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/               # Eloquent models
│   ├── Middleware/           # Custom middleware
│   └── Helpers/              # Helper functions
├── resources/
│   └── views/               # Blade templates
├── public/
│   └── assets/              # Static assets (CSS, JS, images)
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
└── routes/
    └── web.php             # Web routes
```

## 🌐 Multi-Language Support

The application supports 6 languages:
- 🇬🇧 English
- 🇫🇷 French (Français)
- 🇪🇸 Spanish (Español)
- 🇩🇪 German (Deutsch)
- 🇮🇹 Italian (Italiano)
- 🇳🇱 Dutch (Nederlands)

Users can switch languages from the header or footer.

## 💱 Currency System

Supported currencies:
- USD (US Dollar)
- EUR (Euro)
- GBP (British Pound)
- CAD (Canadian Dollar)
- AUD (Australian Dollar)
- And more...

Prices are automatically converted based on the selected currency.

## 🛠️ Tech Stack

- **Backend:** Laravel 11.x
- **Frontend:** Bootstrap 5, Blade Templates
- **Database:** MySQL/MariaDB
- **Assets:** Vite
- **Authentication:** Laravel Breeze (custom)
- **Email:** SMTP (Gmail, etc.)

## 📧 Email Configuration

For email functionality (contact form, notifications):

1. Update `.env` with your SMTP credentials:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   MAIL_ADMIN_EMAIL=admin@yourdomain.com
   ```

2. For Gmail, use [App Passwords](https://support.google.com/accounts/answer/185833)

## 🧪 Testing

Test the email configuration:
```bash
php test-email.php
```

## 📝 Documentation

For detailed documentation, see:
- [SETUP_INSTRUCTIONS.md](docs/SETUP_INSTRUCTIONS.md) - Detailed setup guide
- [SECURITY.md](SECURITY.md) - Security guidelines
- [DEPLOYMENT_AND_UPDATE_GUIDE.md](docs/DEPLOYMENT_AND_UPDATE_GUIDE.md) - Deployment guide
- [docs/](docs/) - Full documentation directory with implementation guides and testing instructions

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 📞 Contact

- **Website:** [United Travels](https://unitedtravels.com)
- **Email:** unitedtravelandservice@gmail.com
- **Phone:** +213 697 49 20 15

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap
- All contributors and supporters

---

**Built with ❤️ for travelers around the world**
