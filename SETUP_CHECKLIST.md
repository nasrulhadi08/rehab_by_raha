# 🚀 Quick Setup Checklist

## Before You Start
- [ ] XAMPP installed and running (Apache + MySQL active)
- [ ] "my website" folder copied to `C:\xampp\htdocs\`

## Step 1: Copy Images
- [ ] Copy `RBR Logoooo.png` to `assets/images/`
- [ ] Copy `Raghib_RBR.jpeg` to `assets/images/`
- [ ] Copy `Shivani_RBR.jpeg` to `assets/images/`
- [ ] Copy `Dr.Abizar_RBR.jpeg` to `assets/images/`
- [ ] Copy `1778564254425.jpg` to `assets/images/`

## Step 2: Test Database
1. Open `http://localhost/phpmyadmin`
2. Verify database `rehab_by_raha` exists
3. Check these tables exist:
   - [ ] appointments
   - [ ] testimonials
   - [ ] experts
   - [ ] services
   - [ ] contact_inquiries

## Step 3: Access Website
- [ ] Open `http://localhost/my website/` in browser
- [ ] Check navigation menu works
- [ ] Scroll through all sections
- [ ] Try booking an appointment (test form)
- [ ] Try adding a review
- [ ] Click expert cards to see modal popups
- [ ] Check contact form works

## Step 4: Verify Database Operations
After testing forms:
1. Go to `http://localhost/phpmyadmin`
2. Check `appointments` table for new entry
3. Check `contact_inquiries` table for message
4. Check `testimonials` table for review

## Step 5: Customize (Optional)
- [ ] Update company info in `index.php`
- [ ] Update phone/email in contact section
- [ ] Adjust colors in `assets/css/style.css` if needed
- [ ] Update expert profiles in phpmyadmin

## Common Issues & Solutions

### Issue: Blank white page
**Solution**: 
- Check `http://localhost/phpmyadmin` 
- Ensure database is created
- Check PHP error logs in `xampp/php/logs/`

### Issue: Images not showing
**Solution**:
- Verify images are in `assets/images/` folder
- Check filenames match exactly
- Use correct extensions (.jpeg, .jpg, .png)

### Issue: Forms not working
**Solution**:
- Open browser developer tools (F12)
- Check Console tab for errors
- Verify `php/` folder files exist

### Issue: Database connection error
**Solution**:
- Ensure MySQL is running
- Check `includes/db_config.php` settings
- Default username: `root`
- Default password: (empty)

## File Structure Verification

Make sure you have these files:
```
my website/
├── index.php                           ✓
├── README.md                           ✓
├── SETUP_CHECKLIST.md                  ✓
├── includes/db_config.php              ✓
├── php/
│   ├── appointments.php                ✓
│   ├── testimonials.php                ✓
│   ├── get_data.php                    ✓
│   └── contact.php                     ✓
├── assets/
│   ├── css/style.css                   ✓
│   ├── js/script.js                    ✓
│   └── images/
│       ├── RBR Logoooo.png            (Add your logo)
│       ├── Raghib_RBR.jpeg            (Add photos)
│       ├── Shivani_RBR.jpeg           (Add photos)
│       ├── Dr.Abizar_RBR.jpeg         (Add photos)
│       ├── 1778564254425.jpg          (Add photos)
│       └── reviews/                    (Auto-created)
```

## Testing Checklist

### Navigation
- [ ] All menu links scroll to correct sections
- [ ] Navbar remains fixed at top
- [ ] Mobile menu toggle works

### Forms
- [ ] Appointment form validates required fields
- [ ] Phone number input accepts only numbers
- [ ] Email validation works
- [ ] Success notification appears
- [ ] Error notification appears for validation errors
- [ ] Database records form submissions

### Content Loading
- [ ] Services load from database
- [ ] Experts load with photos and info
- [ ] Testimonials carousel displays
- [ ] Testimonials auto-scroll every 5 seconds

### Modals
- [ ] Expert modal opens on card click
- [ ] Expert modal closes on X button
- [ ] Expert modal closes on Escape key
- [ ] Expert modal closes on background click
- [ ] Social media links work

### Review System
- [ ] Review button opens modal
- [ ] Star rating works (1-5 stars)
- [ ] Review form validates required fields
- [ ] Success notification appears
- [ ] New reviews appear in carousel
- [ ] Photo upload works (optional)

## Browser Testing
Test on:
- [ ] Google Chrome/Edge
- [ ] Firefox
- [ ] Safari
- [ ] Mobile browser (if available)

## Performance Check
- [ ] Page loads in under 3 seconds
- [ ] Smooth animations and transitions
- [ ] No JavaScript console errors
- [ ] No missing images (no broken image icons)

## SEO Basics
- [ ] Page title is "Rehab By Raha - Professional Rehabilitation Services"
- [ ] Meta description present
- [ ] Mobile viewport meta tag present
- [ ] Heading hierarchy is correct (H1, H2, H3)

## Security Check
- [ ] No sensitive data in URL
- [ ] No console errors showing file paths
- [ ] Form data submits to PHP files (not exposed)
- [ ] Database credentials not visible to frontend

## Final Approval
- [ ] All sections visible and functional
- [ ] All forms working
- [ ] Database operations successful
- [ ] Mobile responsive
- [ ] Ready for client review

---

## 📞 Contact Details Used in Website
(Update these in `index.php` if needed)

**Current Setup:**
- Phone: +91 98765 43210
- Email: rehabbyraha@gmail.com
- Location: Delhi, India
- Hours: Mon-Fri 9AM-7PM, Sat 10AM-6PM, Sun Closed

**Social Media Links:**
- Facebook: https://www.facebook.com/share/1DoVs4s2rd/
- Instagram: https://www.instagram.com/rehab.byraha
- LinkedIn: https://www.linkedin.com/in/rehab-by-raha-75875340a
- WhatsApp: https://wa.me/919876543210

---

**🎉 Once all checks pass, your website is ready to launch!**
