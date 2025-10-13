# ⚡ cPanel Quick Start - 3 Minutes

## 🎬 **Follow Along: PHP Configuration**

This is a **"follow along"** guide. Do exactly what you see here.

---

## **⏱️ STEP 1: Login (30 seconds)**

1. Open browser
2. Go to: `unitedtravel.ma/cpanel`
3. Enter username and password
4. Click "Login"

✅ **You should now see the cPanel dashboard**

---

## **⏱️ STEP 2: Find PHP Settings (30 seconds)**

1. **Look at the cPanel dashboard**
2. **Find the search box** at the top (it says "Search" or has a 🔍 icon)
3. **Type:** `php`
4. **You'll see results** like:
   - "Select PHP Version"
   - "MultiPHP Manager"
5. **Click on "Select PHP Version"** (the first one)

✅ **You should now see a page with PHP settings**

---

## **⏱️ STEP 3: Change PHP Version (30 seconds)**

1. **Look for a dropdown** that shows current PHP version
   - It might say "PHP 7.4" or "PHP 8.1"
2. **Click the dropdown**
3. **Select "8.2"** or "8.3" (whichever is higher)
4. **Click "Set as current"** or "Apply" button
5. **Wait for confirmation** message

✅ **Success message should appear: "PHP version changed"**

---

## **⏱️ STEP 4: Enable Extensions (1 minute)**

1. **Look for tabs** at the top or links on the side
2. **Click "Extensions"** tab
3. **You'll see a LONG list** of checkboxes

**Now, find and CHECK these 12 boxes:**

Type each name in the search box to find it quickly:

```
Type "bcmath"     → ✅ Check the box
Type "ctype"      → ✅ Check the box
Type "fileinfo"   → ✅ Check the box
Type "gd"         → ✅ Check the box
Type "json"       → ✅ Check the box
Type "mbstring"   → ✅ Check the box
Type "openssl"    → ✅ Check the box
Type "pdo"        → ✅ Check the box
Type "pdo_mysql"  → ✅ Check the box
Type "tokenizer"  → ✅ Check the box
Type "xml"        → ✅ Check the box
Type "zip"        → ✅ Check the box
```

4. **Scroll to bottom**
5. **Click "Save"** button
6. **Wait for confirmation**

✅ **Success message: "Extensions updated"**

---

## **⏱️ STEP 5: Change PHP Limits (1 minute)**

1. **Click "Options"** tab (next to "Extensions")
2. **You'll see a form** with many fields

**Find these 4 fields and change them:**

```
Find: "memory_limit"
Current value: 128M (or something else)
Change to: 256M
[Type 256M in the box]

Find: "max_execution_time"
Current value: 30 (or something else)
Change to: 300
[Type 300 in the box]

Find: "upload_max_filesize"
Current value: 2M (or something else)
Change to: 10M
[Type 10M in the box]

Find: "post_max_size"
Current value: 8M (or something else)
Change to: 10M
[Type 10M in the box]
```

3. **Scroll to bottom**
4. **Click "Save"** button
5. **Wait for confirmation**

✅ **Success message: "PHP settings updated"**

---

## **✅ DONE! That's it!**

**You just:**
- ✅ Set PHP to version 8.2
- ✅ Enabled 12 required extensions
- ✅ Increased memory limit to 256M
- ✅ Set upload limits to 10M

**Total time:** ~3 minutes

---

## **🎯 What's Next?**

**Go back to:** `QUICK_CPANEL_DEPLOY.md`

**Continue with:** Step 3 - Upload Files

---

## **❓ Can't Find Something?**

### Can't find the search box?
- Look at the **very top** of cPanel page
- Or scroll down and look for "Software" section
- Click any item that says "PHP"

### Can't find "Select PHP Version"?
- Try "MultiPHP Manager" instead
- Or ask your host support: "Where do I change PHP settings?"

### Extensions already checked?
- That's great! Skip it.
- Someone might have already enabled them.

### Can't change a setting?
- Your host might have restrictions
- Set it to the maximum allowed
- Or contact support: "Please increase PHP memory_limit to 256M"

---

## **🆘 Emergency Help**

**Copy and send this to your hosting support:**

```
Hi,

I'm deploying a Laravel application and need:

1. PHP Version: 8.2 or higher
2. Enable extensions: bcmath, ctype, fileinfo, gd, json, mbstring, 
   openssl, pdo, pdo_mysql, tokenizer, xml, zip
3. Set memory_limit: 256M
4. Set max_execution_time: 300
5. Set upload_max_filesize: 10M
6. Set post_max_size: 10M

Can you help configure these settings for domain: unitedtravel.ma?

Thank you!
```

---

**Simple enough?** Let's continue with file upload! 🚀

