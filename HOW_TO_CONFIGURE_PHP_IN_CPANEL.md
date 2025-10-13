# 🐘 How to Configure PHP in cPanel - Visual Guide

## 📍 You Are Here: Step 2 - PHP Configuration

This guide shows you **exactly** how to configure PHP settings in cPanel with detailed instructions.

---

## 🎯 **Part 1: Finding the PHP Settings**

### Step 1: Login to cPanel
1. Open your browser
2. Go to: `unitedtravel.ma/cpanel` or `unitedtravel.ma:2083`
3. Enter your cPanel username and password
4. Click "Login"

### Step 2: Locate PHP Version Tool
Once logged in, you'll see the cPanel dashboard with many icons.

**Look for one of these tools** (name varies by host):
- 🔹 **"Select PHP Version"** (most common)
- 🔹 **"MultiPHP Manager"**
- 🔹 **"PHP Selector"**
- 🔹 **"PHP Version Manager"**

**Where to find it:**
- Usually in the **"Software"** section
- Or use the search box at top: Type "PHP"

---

## 🎯 **Part 2: Setting PHP Version to 8.2+**

### Method A: Using "Select PHP Version"

1. **Click on "Select PHP Version"**
   
2. **You'll see current PHP version** at the top
   - Example: "PHP 7.4" or "PHP 8.1"

3. **If version is less than 8.2:**
   - Click on the **dropdown menu**
   - Scroll down and select **"8.2"** or **"8.3"** (if available)
   - Click **"Set as current"** or **"Apply"**
   - ✅ Success message: "PHP version changed successfully"

### Method B: Using "MultiPHP Manager"

1. **Click on "MultiPHP Manager"**
   
2. **You'll see a list of your domains**
   - Find your domain: `unitedtravel.ma`
   - Check the checkbox next to it

3. **Look for "PHP Version" dropdown** at the top
   - Select **"ea-php82"** or **"alt-php82"**
   - Click **"Apply"**
   - ✅ Success message appears

---

## 🎯 **Part 3: Enable PHP Extensions**

### Step 1: Access Extensions Settings

**From "Select PHP Version" screen:**
1. Look for a link that says **"Switch To PHP Options"** or **"PHP Extensions"**
2. Click on it

**You'll see two tabs:**
- **Options** (PHP settings like memory_limit)
- **Extensions** (PHP modules)

### Step 2: Enable Required Extensions

1. **Click on "Extensions" tab** (if not already there)

2. **You'll see a LONG list of checkboxes** with extension names

3. **Find and CHECK these boxes:**

   **Essential Extensions (MUST enable):**
   ```
   ✅ bcmath          (for calculations)
   ✅ ctype           (character type checking)
   ✅ fileinfo        (file type detection)
   ✅ gd              (image processing - IMPORTANT!)
   ✅ json            (JSON handling)
   ✅ mbstring        (multi-byte strings - IMPORTANT!)
   ✅ openssl         (encryption/HTTPS)
   ✅ pdo             (database abstraction)
   ✅ pdo_mysql       (MySQL database - IMPORTANT!)
   ✅ tokenizer       (PHP tokenizer)
   ✅ xml             (XML processing)
   ✅ zip             (ZIP file handling)
   ```

4. **How to find them quickly:**
   - Most cPanel interfaces have a **search box** at top
   - Type extension name (e.g., "mbstring")
   - Check the box next to it
   - Repeat for all extensions

5. **After checking all boxes:**
   - Scroll to bottom
   - Click **"Save"** or **"Apply"**
   - ✅ Success message: "Extensions updated"

---

## 🎯 **Part 4: Adjust PHP Settings (Memory, Upload Limits)**

### Step 1: Go to PHP Options

**From "Select PHP Version" screen:**
1. Click **"Switch To PHP Options"** tab (if you were on Extensions tab)
2. Or look for **"Options"** tab at top

### Step 2: Adjust These Settings

You'll see a form with many PHP configuration options. **Find and change these:**

#### 🔧 Setting 1: memory_limit
```
Current value might be: 128M or 64M

Change to: 256M (or higher like 512M)

How:
1. Find "memory_limit" in the list
2. Click in the text box
3. Delete current value
4. Type: 256M
5. Press Enter or Tab
```

#### 🔧 Setting 2: max_execution_time
```
Current value might be: 30 or 60

Change to: 300

How:
1. Find "max_execution_time"
2. Change value to: 300
```

#### 🔧 Setting 3: upload_max_filesize
```
Current value might be: 2M

Change to: 10M

How:
1. Find "upload_max_filesize"
2. Change value to: 10M
```

#### 🔧 Setting 4: post_max_size
```
Current value might be: 8M

Change to: 10M

How:
1. Find "post_max_size"
2. Change value to: 10M
```

### Step 3: Save Changes

1. **Scroll to bottom of the page**
2. Click **"Save"** or **"Apply"** button
3. ✅ Success message: "PHP settings updated successfully"

---

## 🎯 **Part 5: Verify Your Changes**

### Quick Verification

1. **Go back to "Select PHP Version" main screen**
2. **Check PHP version** shows 8.2 or higher ✅
3. **Click "Extensions" tab** - your checked extensions should still be checked ✅
4. **Click "Options" tab** - your settings should show updated values ✅

---

## 📸 **Visual Reference: What You're Looking For**

### cPanel Dashboard
```
┌─────────────────────────────────────────┐
│  cPanel Dashboard                       │
├─────────────────────────────────────────┤
│                                         │
│  [Search box: Type "PHP" here]          │
│                                         │
│  SOFTWARE Section:                      │
│  ┌──────────────┐ ┌──────────────┐    │
│  │ Select PHP   │ │ MultiPHP     │    │
│  │ Version      │ │ Manager      │    │← Click one of these
│  └──────────────┘ └──────────────┘    │
│                                         │
└─────────────────────────────────────────┘
```

### Select PHP Version Screen
```
┌─────────────────────────────────────────────────┐
│  Select PHP Version                             │
├─────────────────────────────────────────────────┤
│                                                 │
│  Current PHP version:                           │
│  [Dropdown: 8.2 ▼]  [Set as current]           │← Change version here
│                                                 │
│  ┌─────────────────┐ ┌──────────────────┐     │
│  │  Extensions     │ │  Options         │     │← Two tabs
│  └─────────────────┘ └──────────────────┘     │
│                                                 │
│  [Search extensions...]                         │
│                                                 │
│  ☑ bcmath                                      │← Check these boxes
│  ☑ ctype                                       │
│  ☑ fileinfo                                    │
│  ☑ gd                                          │
│  ☑ json                                        │
│  ☑ mbstring                                    │
│  ☑ openssl                                     │
│  ☑ pdo                                         │
│  ☑ pdo_mysql                                   │
│  ☑ tokenizer                                   │
│  ☑ xml                                         │
│  ☑ zip                                         │
│                                                 │
│  [Save] [Cancel]                               │← Click Save
│                                                 │
└─────────────────────────────────────────────────┘
```

### PHP Options Screen
```
┌─────────────────────────────────────────────────┐
│  PHP Options                                    │
├─────────────────────────────────────────────────┤
│                                                 │
│  memory_limit:          [256M      ]           │← Change to 256M
│  max_execution_time:    [300       ]           │← Change to 300
│  upload_max_filesize:   [10M       ]           │← Change to 10M
│  post_max_size:         [10M       ]           │← Change to 10M
│  ...more settings...                            │
│                                                 │
│  [Save] [Cancel]                               │← Click Save
│                                                 │
└─────────────────────────────────────────────────┘
```

---

## ✅ **Checklist: Did You Do Everything?**

Go through this checklist:

- [ ] Logged into cPanel
- [ ] Found "Select PHP Version" or "MultiPHP Manager"
- [ ] Set PHP version to 8.2 or higher
- [ ] Enabled all 12 required extensions
- [ ] Set memory_limit to 256M
- [ ] Set max_execution_time to 300
- [ ] Set upload_max_filesize to 10M
- [ ] Set post_max_size to 10M
- [ ] Clicked "Save" on extensions
- [ ] Clicked "Save" on options
- [ ] Verified changes were saved

**All checked?** ✅ You're done with PHP configuration!

---

## 🐛 **Troubleshooting**

### "I can't find 'Select PHP Version'"
**Try these alternatives:**
- Look for "MultiPHP Manager"
- Look for "PHP Selector"
- Look for "CloudLinux PHP Selector"
- Use search box: Type "PHP"
- Contact your host support: "How do I change PHP version and extensions?"

### "The extension I need is not in the list"
**Solution:**
- Some extensions might already be enabled (that's good!)
- Check the "Options" tab - some might be there
- Contact your hosting support to enable it
- Most likely it's already enabled, don't worry

### "I can't change memory_limit above 128M"
**Solution:**
- Some hosts have limits
- Try the maximum allowed
- If it's less than 256M, your site might still work
- Contact support to increase limits

### "Changes are not saving"
**Try:**
1. Clear your browser cache
2. Log out of cPanel and log back in
3. Try a different browser
4. Contact hosting support

### "I don't have SSH/Terminal access"
**Solution:**
- Ask your hosting provider to enable SSH access
- Or they can run the commands for you
- Some hosts offer "Terminal" button in cPanel
- You might need to upgrade your hosting plan

---

## 🎯 **What's Next?**

Once PHP is configured, move to **Part 3: Upload Files**

Go back to: `QUICK_CPANEL_DEPLOY.md` and continue from Step 3.

---

## 💡 **Pro Tips**

1. **Take screenshots** as you make changes (for your records)
2. **Write down** the old values before changing them
3. **If something breaks**, you can always revert to old settings
4. **Most hosts allow these changes** - if not, contact support
5. **Changes take effect immediately** - no restart needed

---

## 📞 **Still Stuck?**

### Option 1: Contact Your Host
**What to say:**
> "Hi, I'm deploying a Laravel application and need PHP 8.2+ with these extensions enabled: bcmath, ctype, fileinfo, gd, json, mbstring, openssl, pdo, pdo_mysql, tokenizer, xml, zip. Can you help configure this?"

### Option 2: Let Your Host Do It
**Send them this:**
> "Please set:
> - PHP Version: 8.2 or higher
> - memory_limit: 256M
> - max_execution_time: 300
> - upload_max_filesize: 10M
> - post_max_size: 10M
> - Enable extensions: bcmath, ctype, fileinfo, gd, json, mbstring, openssl, pdo, pdo_mysql, tokenizer, xml, zip"

---

**You've got this! PHP configuration is usually the easiest part.** 🚀

