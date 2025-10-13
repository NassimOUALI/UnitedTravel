# Root Admin Setup Guide

## 🔐 Secure Root Administrator Configuration

As of the latest security update, the United Travels application no longer uses hard-coded default credentials. Instead, the root administrator account is created from environment variables that YOU set.

---

## ✅ Why This is More Secure

**Before (Insecure):**
- Default credentials were `admin@example.com` / `password`
- Everyone knew these credentials
- Easy to forget to change them
- Vulnerable to attacks if forgotten

**Now (Secure):**
- You set your own credentials before seeding
- No default passwords exist in the codebase
- Seeder will fail if credentials aren't set (preventing accidental default accounts)
- Each installation has unique credentials

---

## 📝 Setup Instructions

### Step 1: Configure Environment Variables

Open your `.env` file and add these variables:

```env
# Root Admin Configuration (REQUIRED)
ROOT_ADMIN_NAME="Your Full Name"
ROOT_ADMIN_EMAIL=your-email@yourdomain.com
ROOT_ADMIN_PASSWORD=your-secure-password-here

# Demo Users (Optional - for testing only)
SEED_DEMO_USERS=false
```

### Step 2: Set Secure Credentials

**For ROOT_ADMIN_EMAIL:**
- Use your real email address
- Use a professional email (e.g., admin@yourcompany.com)
- This email will be used to log into the admin panel

**For ROOT_ADMIN_PASSWORD:**
- Minimum 8 characters required
- Use a strong, unique password
- Include uppercase, lowercase, numbers, and symbols
- Don't use common words or patterns

**Example of a strong password:**
```
MyC0mp@ny2025!Secure
```

### Step 3: Run the Seeder

```bash
php artisan migrate --seed
```

**What happens:**
- The seeder checks if `ROOT_ADMIN_EMAIL` and `ROOT_ADMIN_PASSWORD` are set
- If not set → The seeder will **fail** with a clear error message
- If password is less than 8 characters → The seeder will **fail**
- If everything is valid → Root admin account is created successfully

### Step 4: Login

After seeding, you can login with:
- **URL:** http://your-domain.com/login
- **Email:** The email you set in `ROOT_ADMIN_EMAIL`
- **Password:** The password you set in `ROOT_ADMIN_PASSWORD`

---

## 🧪 Demo Users (Development Only)

### What are Demo Users?

Demo users are test accounts with default passwords:
- `client@example.com` / `password`
- `jane@example.com` / `password`

### Should I Enable Them?

**Development/Testing:** Maybe
```env
SEED_DEMO_USERS=true  # For testing only
```

**Production:** **NEVER**
```env
SEED_DEMO_USERS=false  # Always false in production!
```

### Why Are They Disabled by Default?

- Security risk (weak default passwords)
- Not needed in production
- Prevents accidental exposure
- Best practice to disable by default

---

## ⚠️ Important Security Notes

### DO:
✅ Use strong, unique passwords  
✅ Use your real email address  
✅ Keep `.env` file secure (never commit to Git)  
✅ Set `SEED_DEMO_USERS=false` in production  
✅ Change password after first login (optional but recommended)

### DON'T:
❌ Use weak passwords like "password123"  
❌ Use default emails like "admin@example.com"  
❌ Enable demo users in production  
❌ Share your `.env` file  
❌ Commit credentials to version control

---

## 🔧 Troubleshooting

### Error: "Root admin credentials not found!"

**Problem:** `ROOT_ADMIN_EMAIL` or `ROOT_ADMIN_PASSWORD` not set in `.env`

**Solution:**
```env
# Add these to your .env file
ROOT_ADMIN_EMAIL=your-email@example.com
ROOT_ADMIN_PASSWORD=your-password-here
```

### Error: "ROOT_ADMIN_PASSWORD must be at least 8 characters long"

**Problem:** Your password is too short

**Solution:** Use a password with at least 8 characters:
```env
ROOT_ADMIN_PASSWORD=MySecurePass123!
```

### I Already Ran the Seeder with Old Credentials

**Solution:**
1. Drop all tables: `php artisan migrate:fresh`
2. Update `.env` with new credentials
3. Run seeder again: `php artisan migrate --seed`

### I Forgot My Root Admin Password

**Solution:**
1. Create a new admin user through Laravel Tinker:
   ```bash
   php artisan tinker
   ```
   ```php
   $user = new App\Models\User();
   $user->name = 'New Admin';
   $user->email = 'newadmin@example.com';
   $user->password = bcrypt('new-password');
   $user->is_root = true;
   $user->save();
   
   $user->roles()->attach(App\Models\Role::where('name', 'admin')->first());
   ```

2. Or, reset the database and re-seed:
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## 📊 Environment Variable Reference

| Variable | Required | Default | Description |
|----------|----------|---------|-------------|
| `ROOT_ADMIN_NAME` | Optional | "Root Administrator" | Display name for root admin |
| `ROOT_ADMIN_EMAIL` | **Required** | None | Email for root admin login |
| `ROOT_ADMIN_PASSWORD` | **Required** | None | Password for root admin (min 8 chars) |
| `SEED_DEMO_USERS` | Optional | `false` | Whether to create demo client users |

---

## 🎯 Best Practices

1. **Set credentials before first migration:**
   ```bash
   # 1. Configure .env first
   nano .env  # or your text editor
   
   # 2. Then migrate and seed
   php artisan migrate --seed
   ```

2. **Use environment-specific credentials:**
   - **Development:** Can use simpler passwords for testing
   - **Staging:** Use production-like credentials
   - **Production:** Strong, unique, secure passwords

3. **Document your credentials securely:**
   - Use a password manager
   - Store in encrypted vault
   - Never in plain text files

4. **Regular password updates:**
   - Change passwords periodically
   - Update after team member changes
   - Rotate after security incidents

---

## 🔗 Related Documentation

- [SECURITY.md](../SECURITY.md) - Complete security guidelines
- [SECURITY_ASSESSMENT.md](SECURITY_ASSESSMENT.md) - Security audit report
- [README.md](../README.md) - General setup instructions

---

## 📞 Need Help?

If you have questions about root admin setup:
- Check the troubleshooting section above
- Review [SECURITY.md](../SECURITY.md)
- Contact: unitedtravelandservice@gmail.com

---

**Remember:** Security starts with the first user account. Keep it secure! 🔒

