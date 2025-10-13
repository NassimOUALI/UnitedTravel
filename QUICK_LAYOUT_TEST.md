# ✅ Quick Layout Test Guide

## 5-Minute Visual Check

### **1. Open Destinations Page**
```
http://localhost:8000/destinations
```

---

### **2. Desktop View (1920x1080)**

**Expected Layout:**
```
Row 1:
┌─────────┬─────────────────────────────────────┬─────────┐
│ Dest 0  │         Destination 1               │ Dest 4  │
│ (left)  │      (large center)                 │ (right) │
│         ├─────────────────┬───────────────────┤         │
│         │   Dest 2        │      Dest 3       │         │
│         │   (bottom-left) │   (bottom-right)  │         │
└─────────┴─────────────────┴───────────────────┴─────────┘

Row 2:
┌─────────┬─────────┬─────────┬─────────┐
│ Dest 5  │ Dest 6  │ Dest 7  │ Dest 8  │
└─────────┴─────────┴─────────┴─────────┘
```

**Check:**
- □ 4 items across the top (0, 1 wrapper, 4)
- □ Item 1 spans 2 columns width
- □ Items 2 & 3 are inside item 1's space
- □ All images fill their containers
- □ No white space gaps
- □ Text readable on all cards
- □ Tour count badges visible

---

### **3. Tablet View (768-1199px)**

Press `F12` → Toggle Device Toolbar → iPad

**Expected Layout:**
```
┌─────────┬─────────┐
│ Dest 0  │ Dest 4  │
├─────────┴─────────┤
│    Destination 1   │ (full width)
├─────────┬─────────┤
│ Dest 2  │ Dest 3  │
├─────────┴─────────┤
│ Dest 5  │ Dest 6  │
└─────────┴─────────┘
```

**Check:**
- □ 2 columns layout
- □ Dest 0 and Dest 4 swap positions (4 on right)
- □ Dest 1 spans full width
- □ Images scale properly
- □ No overflow

---

### **4. Mobile View (iPhone 12)**

Press `F12` → Toggle Device Toolbar → iPhone 12 Pro

**Expected Layout:**
```
┌─────────┬─────────┐
│ Dest 0  │ Dest 4  │
├─────────┴─────────┤
│   Destination 1    │
├─────────┬─────────┤
│ Dest 2  │ Dest 3  │
├─────────┴─────────┤
│ Dest 5  │ Dest 6  │
└─────────┴─────────┘
```

**Check:**
- □ Cards stack properly
- □ Images don't overflow screen
- □ Text is readable
- □ Badges scale down
- □ Touch targets adequate

---

### **5. Image Tests**

**Hover over each card:**
- □ Image zooms smoothly (scale 1.08)
- □ No jerky animation
- □ Overlay stays in place
- □ Badge doesn't move

**Check different images:**
- □ Portrait images: Crop properly (no stretch)
- □ Landscape images: Fill width (no distortion)
- □ Square images: Center properly

---

### **6. Specific Element Checks**

**Gradients:**
- □ Dark gradient at bottom of each card
- □ Text has good contrast with image
- □ Gradient fades smoothly to transparent

**Badges (Tour Count):**
- □ White background
- □ Top-right corner
- □ Rounded pill shape
- □ Clear text

**Icons:**
- □ Pin icon visible
- □ White/translucent background
- □ Centered properly

**Typography:**
- □ Destination name: Large, bold, white
- □ Location: Smaller, white, 75% opacity
- □ All text readable on any image

---

### **7. Layout Integrity**

**Resize browser window:**
- □ Layout responds smoothly
- □ No sudden jumps
- □ Breakpoints at 1200px and 768px
- □ No horizontal scrollbar at any size

**Scroll page:**
- □ Cards load properly
- □ Pagination works
- □ No layout shifts

---

### **8. Grid Pattern Test**

**Count the destinations:**
- First 7 should follow: 1-left, 3-center (1 large + 2 small), 1-right, 2-bottom
- Next 7 should repeat the same pattern
- Pattern continues for all destinations

---

## 🎯 Pass/Fail Criteria:

### **✅ PASS if:**
- Desktop shows unique 7-item grid pattern
- Images fill containers without overflow
- Responsive layouts work on all sizes
- No horizontal scrollbars
- Text is readable on all cards
- Hover effects work smoothly

### **❌ FAIL if:**
- Images stretched or distorted
- Horizontal scrollbar appears
- Cards different heights in same row
- Text not readable (poor contrast)
- Layout breaks on mobile
- Grid pattern doesn't match template

---

## 🐛 Quick Fixes:

### **If images are stretched:**
```
Check: object-fit: cover is applied
Fix: Hard refresh (Ctrl+Shift+R)
```

### **If layout is broken:**
```
Check: View cache cleared
Fix: php artisan view:clear
```

### **If pattern is wrong:**
```
Check: First 7 destinations
Should be: 0, 1-3 (nested), 4, 5, 6
```

---

## 📊 Expected Measurements:

### **Desktop Card Heights:**
- Position 0, 4: ~350px
- Position 1 (large): ~350px
- Position 2, 3: ~250px
- Position 5, 6: ~350px

### **Mobile Card Heights:**
- All positions: ~220px (consistent)

### **Image Constraints:**
- Max height: 500px
- Width: 100% of container
- Object-fit: cover
- Never exceed container

---

## ✅ You're Done When:

1. ✅ Desktop shows professional masonry layout
2. ✅ All images display properly without breaking
3. ✅ Mobile/tablet responsive works perfectly
4. ✅ Hover effects are smooth
5. ✅ No console errors
6. ✅ Matches template aesthetic

---

**Test Time:** ~5 minutes  
**Priority:** High  
**Status:** Ready to Test

Visit: **http://localhost:8000/destinations**

