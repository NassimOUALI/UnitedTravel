# Security Guidelines for UnitedTravels

## 🔒 Important Security Notes

### Environment Configuration

**CRITICAL**: Never commit your `.env` file to version control!

The `.env` file contains sensitive information such as:
- Database credentials
- Mail server passwords
- Application keys
- API tokens

### Initial Setup Security Checklist

When deploying this application, ensure you:

1. **Generate a new application key:**
   ```bash
   php artisan key:generate
   ```

2. **Change default demo user credentials:**
   
   The seeder creates demo users with default passwords:
   - `admin@example.com` / `password` (Admin)
   - `client@example.com` / `password` (Client)
   - `jane@example.com` / `password` (Client)

   **⚠️ IMPORTANT**: Either:
   - Delete these users after creating your own admin account, OR
   - Change their passwords immediately in production
   - Don't run the seeder on production environments

3. **Update email configuration:**
   - Use your own SMTP credentials
   - Never use default/example email addresses in production

4. **Database security:**
   - Use strong, unique database passwords
   - Never use `root` with no password in production
   - Restrict database access to localhost only

5. **Set proper file permissions:**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

6. **Configure proper CORS and CSRF protection:**
   - Review and update CORS settings in production
   - Ensure CSRF tokens are properly validated

7. **Update APP_ENV to production:**
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

