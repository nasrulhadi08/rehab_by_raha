# Rehab By Raha - Professional Physiotherapy Website

A modern, responsive PHP/MySQL-based website for a physiotherapy rehabilitation center with glass morphism design, dynamic content management, and user interaction features.

## 🎯 Features

### Frontend Features
- **Glass Morphism Navbar**: Modern, blur-effect navigation with smooth transitions
- **Hero Section**: Eye-catching landing section with appointment booking form
- **About Section**: Company mission, vision, and values
- **Services Section**: Dynamic service cards loaded from database
- **Experts Section**: Team member profiles with modal popups showing detailed information
- **Testimonials Carousel**: Automatic scrolling carousel for client reviews
- **Review System**: Clients can add reviews which appear in the carousel
- **Contact Section**: Contact information and inquiry form
- **Responsive Design**: Mobile-first, works perfectly on all devices

### Backend Features
- **PHP Backend**: Secure server-side processing
- **MySQL Database**: Persistent data storage with proper schema
- **Appointment Booking**: Clients can book appointments with validation
- **Review Management**: Moderation-ready testimonial system
- **Contact Inquiries**: Track customer messages and inquiries
- **Expert Management**: Dynamic expert profile system with social media links
- **Admin Panel**: Manage appointments, contact messages, and testimonials from a secured dashboard

### User Notifications
- Toast notifications for all user actions (success/error)
- Real-time feedback on form submissions
- Auto-dismissing alerts

## 🔐 Admin Panel
The admin panel is available at `admin/index.php`.
Default login credentials:
- Username: `admin`
- Password: `password`


## 📁 Project Structure

```
my website/
├── index.php                 # Main homepage
├── includes/
│   └── db_config.php        # Database configuration & initialization
├── php/
│   ├── appointments.php     # Appointment handling
│   ├── testimonials.php     # Review/testimonial handling
│   ├── get_data.php         # Fetch experts, services data
│   └── contact.php          # Contact inquiry handling
├── assets/
│   ├── css/
│   │   └── style.css        # All styling (glass morphism, animations)
│   ├── js/
│   │   └── script.js        # All JavaScript functionality
│   └── images/
│       ├── RBR Logoooo.png  # Company logo
│       ├── reviews/         # Client review photos
│       └── [expert photos]  # Team member photos
└── README.md
```

## 🗄️ Database Schema

### Tables Created Automatically

#### 1. **appointments** Table
```sql
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    preferred_date DATE,
    preferred_time TIME,
    service_type VARCHAR(100),
    message TEXT,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX(created_at)
);
```

#### 2. **testimonials** Table
```sql
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    rating INT DEFAULT 5,
    comment TEXT NOT NULL,
    photo_url VARCHAR(255),
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX(created_at),
    INDEX(status)
);
```

#### 3. **experts** Table
```sql
CREATE TABLE experts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    title VARCHAR(100),
    qualification TEXT,
    bio TEXT,
    photo_url VARCHAR(255),
    linkedin_url VARCHAR(255),
    instagram_url VARCHAR(255),
    specialization VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 4. **services** Table
```sql
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 5. **contact_inquiries** Table
```sql
CREATE TABLE contact_inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX(created_at),
    INDEX(status)
);
```

## 🚀 Setup Instructions

### Prerequisites
- XAMPP or WAMP installed on Windows
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Modern web browser

### Step 1: Install XAMPP (If not already installed)
1. Download from https://www.apachefriends.org/
2. Install with default settings
3. Start Apache and MySQL from XAMPP Control Panel

### Step 2: Copy Files to htdocs
1. Copy the entire "my website" folder to: `C:\xampp\htdocs\`
2. The path should be: `C:\xampp\htdocs\my website\`

### Step 3: Add Images
1. Copy your logo image (`RBR Logoooo.png`) to: `C:\xampp\htdocs\my website\assets\images\`
2. Copy expert photos to the same directory with exact filenames:
   - `Raghib_RBR.jpeg`
   - `Shivani_RBR.jpeg`
   - `Dr.Abizar_RBR.jpeg`
   - `1778564254425.jpg`

### Step 4: Create Database
The database will be created automatically on first load, but you can also:
1. Open phpMyAdmin at `http://localhost/phpmyadmin`
2. The database `rehab_by_raha` will be created automatically
3. Tables and sample data will be inserted on first page load

### Step 5: Access the Website
Open your browser and navigate to:
```
http://localhost/my website/
```

## 📝 Configuration

### Database Configuration
Edit `includes/db_config.php` if using non-default credentials:
```php
$servername = "localhost";
$username = "root";        // Default XAMPP username
$password = "";            // Default XAMPP password (empty)
$dbname = "rehab_by_raha";
```

### Customize Content
1. **Company Information**: Edit the hero section and about section in `index.php`
2. **Contact Details**: Update phone, email, and address in the contact section
3. **Colors**: Modify CSS variables in `assets/css/style.css`:
   ```css
   :root {
       --primary-color: #0D6B9C;      /* Change these */
       --secondary-color: #1BA09A;
       --tertiary-color: #F39C12;
   }
   ```

## 🎨 Design Features

### Color Palette
- **Primary Blue**: `#0D6B9C` - Professional medical blue
- **Teal Accent**: `#1BA09A` - Modern secondary color
- **Orange Accent**: `#F39C12` - Warm highlights
- **Success Green**: `#27AE60` - Positive actions
- **Error Red**: `#E74C3C` - Error states

### Glass Morphism Effects
- Blurred semi-transparent backgrounds
- Smooth transitions and hover effects
- Modern backdrop-filter CSS
- Compatible with modern browsers

### Responsive Breakpoints
- Desktop: 1400px max-width
- Tablet: 768px
- Mobile: 480px

## 🔧 Admin Functions

### View Appointments (in phpMyAdmin)
1. Go to `http://localhost/phpmyadmin`
2. Select database `rehab_by_raha`
3. Click on `appointments` table
4. View all booked appointments

### View Contact Inquiries
1. Go to `http://localhost/phpmyadmin`
2. Select `contact_inquiries` table
3. Manage inquiry status (new/read/replied)

### Manage Testimonials
1. Go to `http://localhost/phpmyadmin`
2. Select `testimonials` table
3. Change status from 'pending' to 'approved' to display on website

### Update Experts
1. Go to `http://localhost/phpmyadmin`
2. Edit `experts` table to update profiles
3. Changes appear immediately on website

### Update Services
1. Go to `http://localhost/phpmyadmin`
2. Edit `services` table
3. Services load dynamically on website

## 🔐 Security Features

- **Input Validation**: All form inputs are validated server-side
- **Sanitization**: HTML special characters are escaped
- **SQL Injection Protection**: Prepared statements with parameterized queries
- **File Upload Validation**: Only images allowed, max 5MB
- **CORS Safe**: Proper headers for API responses

## 🌐 Browser Compatibility

- Chrome/Edge 90+
- Firefox 88+
- Safari 14+
- Mobile browsers (iOS Safari, Chrome Mobile)

## 📞 Contact Information

**Default Contact Details** (Update in index.php):
- Phone: +91 98765 43210
- Email: rehabbyraha@gmail.com
- Location: Delhi, India

## 🔄 Workflow

1. **User visits website** → Sees hero with appointment form
2. **User books appointment** → Gets success notification → Data saved to DB
3. **User views testimonials** → Auto-scrolling carousel of approved reviews
4. **User adds review** → Review form opens → Submitted to DB → Auto-added to carousel
5. **User views experts** → Click photo → Modal popup with details and social links
6. **User contacts** → Fills form → Data saved → Gets notification

## 📱 Mobile Responsiveness

All sections are fully responsive:
- Navigation collapses to hamburger menu
- Grid layouts adapt to single column
- Forms resize appropriately
- Modals adjust to screen size
- Carousel scrolls horizontally on mobile

## 🎯 Future Enhancements

Consider adding:
- Admin login panel
- Online payment integration
- Appointment confirmation emails
- SMS notifications
- Blog section
- Video testimonials
- Doctor prescriptions system
- Patient profile management

## 📄 License

Created for Rehab By Raha - 2026

## ⚠️ Important Notes

1. **First Load**: The first page load might take a moment as it creates the database and tables
2. **Image Paths**: Ensure image filenames match exactly (case-sensitive on some servers)
3. **File Uploads**: Create `assets/images/reviews/` folder manually if uploads fail
4. **PHP Errors**: Enable error logging in `php.ini` for debugging if needed

## 🆘 Troubleshooting

### White screen of death
- Check `php error_log` file
- Ensure `includes/db_config.php` is readable
- Verify database credentials

### Database connection error
- Ensure MySQL is running in XAMPP
- Check username/password in `db_config.php`
- Verify database name is correct

### Images not loading
- Ensure images are in `assets/images/` folder
- Check filename matches database entries
- Verify file permissions (chmod 644)

### Forms not submitting
- Check browser console for JavaScript errors
- Ensure PHP files in `/php/` folder are accessible
- Verify form field names match PHP script names

## 📞 Support

For issues or questions:
1. Check error logs in browser console (F12)
2. Check PHP error logs in XAMPP/logs/
3. Verify database tables in phpMyAdmin
4. Test API endpoints directly in browser

---

**Built with ❤️ for Rehab By Raha**
