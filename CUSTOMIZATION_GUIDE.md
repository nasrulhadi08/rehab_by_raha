# 🎨 Customization Guide

## How to Personalize Your Website

This guide shows you exactly where to make changes to customize the website for your specific needs.

---

## 1️⃣ COMPANY BRANDING

### Change Company Name
**File**: `index.php`

Find and replace:
```html
<!-- In navbar -->
<span>Rehab By Raha</span>

<!-- In footer -->
<p>&copy; 2026 Rehab By Raha. All rights reserved.</p>
```

With your company name.

### Update Logo
**File**: `assets/images/RBR Logoooo.png`

1. Rename your logo to: `RBR Logoooo.png`
2. Place in: `assets/images/`
3. Adjust size in CSS if needed (currently 50px height)

**Or change the path in index.php:**
```html
<img src="assets/images/YOUR_LOGO_NAME.png" alt="RBR Logo">
```

### Change Colors

**File**: `assets/css/style.css`

Find the `:root` section (very top of CSS):
```css
:root {
    --primary-color: #0D6B9C;      /* Change this to your primary color */
    --secondary-color: #1BA09A;    /* Change to your secondary color */
    --tertiary-color: #F39C12;     /* Change to your accent color */
}
```

**Color Suggestions:**
- Medical/Health: Blues, teals, greens
- Corporate: Dark blue, gray, accent color
- Wellness: Greens, earth tones
- Spa/Relaxation: Soft colors, pastels

**Use a color picker**: https://htmlcolorcodes.com/

---

## 2️⃣ HERO SECTION (Main Banner)

**File**: `index.php` - Search for `<!-- ============ HERO SECTION`

### Change Main Heading
```html
<h1>Precision Rehab<br><span style="color: #1BA09A;">Lasting Results</span></h1>
```

Change to:
```html
<h1>Your Company<br><span style="color: #1BA09A;">Your Tagline</span></h1>
```

### Change Description
```html
<p>Welcome to our Rehab Center — where healing begins with care...</p>
```

Replace with your own company description.

### Change Button Text
```html
<a href="#contact" class="cta-button">Contact Us</a>
<a href="#appointment" class="cta-button secondary">Book Appointment</a>
```

Update text and links as needed.

---

## 3️⃣ CONTACT INFORMATION

**File**: `index.php` - Search for `<!-- ============ CONTACT SECTION`

### Update Phone Number
```html
<h4>📞 Phone</h4>
<p><a href="tel:+919876543210">+91 98765 43210</a></p>
```

Change phone number in both places (display and link).

### Update Email
```html
<h4>📧 Email</h4>
<p><a href="mailto:rehabbyraha@gmail.com">rehabbyraha@gmail.com</a></p>
```

### Update Address
```html
<h4>📍 Location</h4>
<p>Delhi, India</p>
```

### Update Working Hours
```html
<h4>🕐 Working Hours</h4>
<p>Monday - Friday: 9:00 AM - 7:00 PM<br>
   Saturday: 10:00 AM - 6:00 PM<br>
   Sunday: Closed</p>
```

---

## 4️⃣ ABOUT SECTION

**File**: `index.php` - Search for `<!-- ============ ABOUT SECTION`

### Change About Content
```html
<h2>About Us</h2>
<p>Rehab by Raha is dedicated to providing quality physiotherapy...</p>
```

Update with your company's about information.

### Change Mission
```html
<h3>🎯 Our Mission</h3>
<p>To deliver exceptional rehabilitation and wellness services...</p>
```

### Change Vision
```html
<h3>👁️ Our Vision</h3>
<p>To become a trusted and leading rehabilitation...</p>
```

### Change Values
```html
<h3>💡 Our Values</h3>
<p>✓ Patient-Centric Care | ✓ Professional Excellence | ...</p>
```

### Change About Image
```html
<img src="https://via.placeholder.com/500x400?text=Professional+Rehabilitation" alt="Our Team">
```

Replace placeholder with your own image:
1. Save image as: `assets/images/about.jpg`
2. Change src to: `assets/images/about.jpg`

---

## 5️⃣ SERVICES SECTION

Services are loaded from database automatically. To customize:

### Option A: Use phpMyAdmin (Recommended)
1. Go to: `http://localhost/phpmyadmin`
2. Select database: `rehab_by_raha`
3. Click table: `services`
4. Click "Insert" to add new services
5. Changes appear on website immediately

### Option B: Edit in Database
Each service has:
- **name**: Service title
- **description**: Service details
- **icon**: Icon name (currently unused)

---

## 6️⃣ EXPERTS/TEAM MEMBERS

### Update Existing Experts

**Option A: phpMyAdmin (Recommended)**
1. Go to: `http://localhost/phpmyadmin`
2. Select `experts` table
3. Click edit (pencil icon) on any expert
4. Update fields:
   - name: Full name
   - title: Job title
   - qualification: Education & credentials
   - bio: Professional biography
   - photo_url: Path to photo (e.g., `RBR_photo.jpeg`)
   - linkedin_url: LinkedIn profile
   - instagram_url: Instagram profile

### Add New Expert

1. In phpMyAdmin, click "Insert" on `experts` table
2. Fill all fields:
   ```
   name: John Smith
   title: Lead Physiotherapist
   qualification: BPT, MPT Orthopedics
   bio: [Professional biography]
   photo_url: john_smith.jpeg
   linkedin_url: https://linkedin.com/in/johnsmith
   instagram_url: https://instagram.com/johnsmith
   ```
3. Click "Go"
4. Expert appears on website automatically

### Update Expert Photos

1. Add photo to: `assets/images/`
2. Use exact filename in database (e.g., `john_smith.jpeg`)
3. Extension matters! Use `.jpeg` or `.jpg` consistently

---

## 7️⃣ FOOTER

**File**: `index.php` - Scroll to bottom

### Change Footer Text
```html
<p>&copy; 2026 Rehab By Raha. All rights reserved.</p>
<p>Built with ❤️ for your health and wellness</p>
```

### Change Footer Links
```html
<a href="#home">Home</a>
<a href="#about">About</a>
<a href="#services">Services</a>
<a href="#contact">Contact</a>
```

Add/remove links as needed.

---

## 8️⃣ SOCIAL MEDIA LINKS

**File**: `index.php`

Find social media section in Contact area:
```html
<a href="https://www.facebook.com/share/1DoVs4s2rd/" target="_blank">f</a>
<a href="https://www.instagram.com/rehab.byraha" target="_blank">📷</a>
<a href="https://www.linkedin.com/in/rehab-by-raha-75875340a" target="_blank">in</a>
```

Replace URLs with your social media profiles.

---

## 9️⃣ APPOINTMENT FORM OPTIONS

**File**: `index.php` - Search for `<!-- Service Type -->`

The appointment form has a dropdown for services:
```html
<select id="appt_service" name="service_type">
    <option value="">Select a service</option>
    <option value="Corporate Physiotherapy">Corporate Physiotherapy</option>
    <option value="Posture Correction">Posture Correction</option>
    <!-- Add more options here -->
</select>
```

To customize:
1. Keep the first option (empty)
2. Add your service options
3. Match the names in the services section

---

## 🔟 STYLING CUSTOMIZATIONS

### Change Font
**File**: `assets/css/style.css`

Find:
```css
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
```

Popular alternatives:
```css
/* Modern tech look */
font-family: 'Inter', 'Helvetica Neue', sans-serif;

/* Classic professional */
font-family: 'Georgia', 'Times New Roman', serif;

/* Friendly approachable */
font-family: 'Poppins', 'Quicksand', sans-serif;
```

### Change Spacing
All spacing uses `rem` units. To make the site more spacious:
```css
section {
    padding: 5rem 2rem;  /* Change 5rem to 6rem or 7rem */
}
```

### Change Border Radius (Rounded Corners)
Find instances like:
```css
border-radius: 20px;  /* Change this number */
border-radius: 15px;
border-radius: 10px;
```

Smaller number = sharper corners
Larger number = rounder corners

---

## 1️⃣1️⃣ ANIMATION SPEED

**File**: `assets/css/style.css`

All animations use:
```css
--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
```

To make animations faster/slower:
- `0.3s` = 300 milliseconds (current)
- `0.2s` = faster
- `0.5s` = slower

---

## 1️⃣2️⃣ GLASS MORPHISM BLUR

**File**: `assets/css/style.css`

Components with glass effect have:
```css
backdrop-filter: blur(20px);
-webkit-backdrop-filter: blur(20px);
```

The `20px` controls blur intensity:
- `10px` = lighter blur
- `20px` = standard (current)
- `30px` = heavy blur

---

## 1️⃣3️⃣ FORM CUSTOMIZATION

### Change Form Validation Rules

**File**: `php/appointments.php`

Find validation section and modify:
```php
if (empty($name) || empty($phone)) {
    $response['message'] = 'Name and phone number are required.';
}
```

### Change Required Fields

In `index.php`, find appointment form:
```html
<input type="text" ... required>  <!-- Required field -->
<input type="email">              <!-- Optional field -->
```

Add or remove `required` attribute.

---

## 1️⃣4️⃣ DATABASE CUSTOMIZATION

### Add New Fields to Appointments

1. **In phpMyAdmin**, click "Structure" tab for `appointments`
2. Click "Add" at bottom
3. Add new column:
   - Name: e.g., `special_requests`
   - Type: `TEXT`
   - Click "Go"

4. **In index.php**, add form field:
```html
<div class="form-group">
    <label for="special">Special Requests</label>
    <textarea id="special" name="special_requests"></textarea>
</div>
```

5. **In php/appointments.php**, add parameter handling

---

## 1️⃣5️⃣ META TAGS (SEO)

**File**: `index.php` - In `<head>` section

```html
<meta name="description" content="Customize this description">
<meta name="keywords" content="keyword1, keyword2, keyword3">
```

Update with your keywords and description.

---

## 🔄 COMMON CUSTOMIZATION EXAMPLES

### Example 1: Add WhatsApp Button
```html
<a href="https://wa.me/919876543210" class="cta-button">
    Chat on WhatsApp
</a>
```

### Example 2: Add Video to Hero
```html
<video autoplay muted loop style="width: 100%; border-radius: 20px;">
    <source src="assets/video/promo.mp4" type="video/mp4">
</video>
```

### Example 3: Add Newsletter Signup
```html
<div class="newsletter">
    <input type="email" placeholder="Enter your email">
    <button>Subscribe</button>
</div>
```

Then add CSS for styling.

---

## ⚙️ ADVANCED CUSTOMIZATION

### Add Google Analytics
In `index.php`, before `</head>`:
```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'YOUR_GA_ID');
</script>
```

### Add reCAPTCHA
1. Get API key from: https://www.google.com/recaptcha/admin
2. Add to forms in `index.php`
3. Verify in PHP files

### Add Payment Integration
For online payments, integrate:
- Razorpay
- Stripe
- PayPal

Examples can be added to appointment form.

---

## 📝 BEST PRACTICES

✅ **Always backup** before making changes
✅ **Test changes** before deploying
✅ **Keep colors** consistent across site
✅ **Update both** PHP and HTML for changes
✅ **Use meaningful** filenames for images
✅ **Check mobile** view after changes
✅ **Update meta** tags for SEO

---

## 🆘 MADE A MISTAKE?

### Undo Changes:
1. **In phpMyAdmin**: Just re-enter old data
2. **In code files**: 
   - Use Ctrl+Z if in editor
   - Or restore from backup

### Restore Database:
1. Go to phpMyAdmin
2. Click your database
3. Click "Import"
4. Select backup SQL file
5. Click "Go"

---

## 📚 USEFUL RESOURCES

- **Color Picker**: https://htmlcolorcodes.com/
- **Font Pairs**: https://www.fontpair.co/
- **Icon Library**: https://ionicons.com/
- **Image Placeholder**: https://via.placeholder.com/
- **CSS Gradients**: https://www.gradientmagic.com/
- **Web Fonts**: https://fonts.google.com/

---

## ✨ CUSTOMIZATION CHECKLIST

- [ ] Update company name
- [ ] Change logo image
- [ ] Update color scheme
- [ ] Customize hero section text
- [ ] Add company about information
- [ ] Update contact phone
- [ ] Update contact email
- [ ] Update address/location
- [ ] Update working hours
- [ ] Add team member photos
- [ ] Update expert profiles
- [ ] Customize services
- [ ] Add social media links
- [ ] Test on mobile
- [ ] Verify all forms work
- [ ] Check database data

---

**Once customized, your website will be uniquely yours! 🎉**
