# Security Guidelines for UnitedTravels

## 🔒 Important Security Notes

### Environment Configuration

**CRITICAL**: Never commit your `.env` file to version control!

The `.env` file contains sensitive information such as:
- Database credentials
- Mail server passwords
- Application keys
- API tokens

### Rate Limiting & Bot Protection

The application includes multiple layers of bot protection:

1. **Rate Limiting** (Already active):
   - Login attempts: 5 per minute
   - Registration attempts: 3 per minute
   - Contact form submissions: 3 per minute

2. **Google reCAPTCHA v3** (Requires setup):
   - Invisible CAPTCHA on login and registration
   - Score-based verification (0.0-1.0)
   - See `RECAPTCHA_SETUP.md` for configuration guide

3. **Security Headers**:
   - Content Security Policy (CSP)
   - XSS Protection
   - Frame Options
   - HTTPS Strict Transport Security

### Initial Setup Security Checklist

When deploying this application, ensure you:

1. **Generate a new application key:**
   ```bash
   php artisan key:generate
   ```

2. **Set secure root admin credentials:**
   
   Before running the seeder, you MUST set these in your `.env` file:
   ```env
   ROOT_ADMIN_NAME="Your Name"
   ROOT_ADMIN_EMAIL=your-secure-email@yourdomain.com
   ROOT_ADMIN_PASSWORD=your-strong-password-here
   ```

   **✅ IMPORTANT**: 
   - Use a strong, unique password (minimum 8 characters)
   - Use your real email address
   - Never commit these credentials to version control
   - The seeder will fail if these are not set

3. **Disable demo users in production:**
   
   Demo client users are disabled by default (`SEED_DEMO_USERS=false`)
   
   **⚠️ NEVER** enable demo users in production:
   ```env
   # In .env file (production)
   SEED_DEMO_USERS=false  # Keep this false!
   ```

4. **Configure Google reCAPTCHA (Recommended):**
   ```env
   RECAPTCHA_ENABLED=true
   RECAPTCHA_SITE_KEY=your_site_key_here
   RECAPTCHA_SECRET_KEY=your_secret_key_here
   RECAPTCHA_SCORE_THRESHOLD=0.5
   ```
   See `RECAPTCHA_SETUP.md` for detailed setup instructions.

5. **Update email configuration:**
   - Use your own SMTP credentials
   - Never use default/example email addresses in production

6. **Database security:**
   - Use strong, unique database passwords
   - Never use `root` with no password in production
   - Restrict database access to localhost only

7. **Set proper file permissions:**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

7. **Configure proper CORS and CSRF protection:**
   - Review and update CORS settings in production
   - Ensure CSRF tokens are properly validated

8. **Update APP_ENV to production:**
   ```
   APP_ENV=production
   APP_DEBUG=false
   ```

## 🛡️ Production Environment Variables

Required secure environment variables:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_GENERATED_KEY_HERE

# Root Admin (REQUIRED for seeding)
ROOT_ADMIN_NAME="Your Name"
ROOT_ADMIN_EMAIL=admin@yourdomain.com
ROOT_ADMIN_PASSWORD=your_strong_unique_password

# Demo Users (MUST be false in production)
SEED_DEMO_USERS=false

DB_PASSWORD=your_strong_unique_password

MAIL_USERNAME=your_actual_email@domain.com
MAIL_PASSWORD=your_secure_app_password
MAIL_ADMIN_EMAIL=admin@yourdomain.com
```

## 📋 Security Best Practices

1. **Keep dependencies updated:**
   ```bash
   composer update
   npm update
   ```

2. **Enable HTTPS in production:**
   - Use SSL/TLS certificates
   - Force HTTPS in `.env`: `APP_URL=https://yourdomain.com`

3. **Backup your database regularly:**
   - Encrypt backups
   - Store backups securely off-site

4. **Monitor logs for suspicious activity:**
   - Check `storage/logs/laravel.log` regularly
   - Set up automated alerts for errors

5. **Rate limiting:**
   - The application has built-in rate limiting
   - Adjust limits based on your traffic patterns

6. **File uploads:**
   - Validate all file uploads
   - Store uploaded files outside public directory
   - Implement file size limits

## 🚨 Reporting Security Vulnerabilities

If you discover a security vulnerability, please email:
- **Email**: unitedtravelandservice@gmail.com
- **Subject**: [SECURITY] Vulnerability Report

Please do NOT open a public issue for security vulnerabilities.

## 📝 Additional Resources

- [Laravel Security Best Practices](https://laravel.com/docs/11.x/security)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)

---

**Last Updated**: January 2025

