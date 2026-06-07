# 🗄️ Database Management Guide

## Accessing phpMyAdmin

1. **Start XAMPP**
   - Open XAMPP Control Panel
   - Click "Start" for Apache
   - Click "Start" for MySQL

2. **Open phpMyAdmin**
   - Go to: `http://localhost/phpmyadmin`
   - Default username: `root`
   - Password: (leave blank)
   - Click "Go"

## Database Structure

### Database Name: `rehab_by_raha`

---

## 📋 Tables Overview

### 1. APPOINTMENTS TABLE

**Purpose**: Store appointment booking requests

**Fields:**
- `id` - Unique identifier (Auto-increment)
- `name` - Client's full name
- `phone` - Contact phone number
- `email` - Client's email address
- `preferred_date` - Desired appointment date
- `preferred_time` - Desired appointment time
- `service_type` - Type of service requested
- `message` - Additional notes/message
- `status` - Appointment status (pending/confirmed/completed/cancelled)
- `created_at` - Timestamp when booking was made

**How to View:**
1. Click "rehab_by_raha" database
2. Click "appointments" table
3. See all client bookings here

**How to Update Status:**
1. Click on any appointment row
2. Change status dropdown
3. Click "Go" to save

---

### 2. TESTIMONIALS TABLE

**Purpose**: Store client reviews and ratings

**Fields:**
- `id` - Unique identifier
- `client_name` - Name of reviewer
- `rating` - Star rating (1-5)
- `comment` - Review text
- `photo_url` - Path to reviewer's photo
- `status` - approval status (pending/approved/rejected)
- `created_at` - When review was submitted

**How to Approve Reviews:**
1. Click "testimonials" table
2. Find pending reviews (status = 'pending')
3. Change status to 'approved'
4. Approved reviews appear in website carousel

**Example Data:**
```
client_name: John Doe
rating: 5
comment: "Great service, very professional team!"
status: approved
```

---

### 3. EXPERTS TABLE

**Purpose**: Store team member profiles

**Fields:**
- `id` - Expert ID
- `name` - Full name
- `title` - Job title/designation
- `qualification` - Education and credentials
- `bio` - Professional biography
- `photo_url` - Path to profile photo
- `linkedin_url` - LinkedIn profile URL
- `instagram_url` - Instagram profile URL
- `specialization` - Area of expertise
- `created_at` - Record creation date

**Pre-populated Experts:**
1. Raghib Raza - Founder & Director
2. Shivani Upneja - Co-Founder & Partner
3. Dr. Abizar Rangwala - Senior Physiotherapist
4. Md Nasrul Hadi - Web Developer

**How to Edit Expert:**
1. Click "experts" table
2. Click the edit icon (pencil) next to any expert
3. Update fields as needed
4. Click "Save" (checkmark)

**How to Add New Expert:**
1. Click "Insert" tab in "experts" table
2. Fill in all fields
3. Click "Go"
4. Expert appears on website automatically

---

### 4. SERVICES TABLE

**Purpose**: Store available services

**Fields:**
- `id` - Service ID
- `name` - Service name
- `description` - Service description
- `icon` - Icon name (for future use)
- `created_at` - Creation date

**Pre-populated Services:**
1. Corporate Physiotherapy
2. Posture Correction
3. Ergonomic Assessment
4. Neck & Back Pain Rehabilitation
5. Home Visit Physiotherapy
6. Sports Injury Rehabilitation

**How to Add Service:**
1. Click "services" table
2. Click "Insert"
3. Enter service name and description
4. Click "Go"

---

### 5. CONTACT_INQUIRIES TABLE

**Purpose**: Store contact form submissions

**Fields:**
- `id` - Inquiry ID
- `name` - Sender's name
- `email` - Sender's email
- `phone` - Sender's phone
- `subject` - Inquiry subject
- `message` - Full message
- `status` - Follow-up status (new/read/replied)
- `created_at` - When submitted

**How to Track Inquiries:**
1. Click "contact_inquiries" table
2. Filter by status:
   - `new` = Not yet reviewed
   - `read` = Reviewed
   - `replied` = Response sent
3. Change status as you handle each inquiry

---

## 🔄 Common Database Operations

### Adding Sample Data

**Add Test Appointment:**
1. Click "appointments" table
2. Click "Insert"
3. Fill in:
   - name: "Test Client"
   - phone: "9876543210"
   - email: "test@example.com"
   - preferred_date: [Pick a date]
   - service_type: "Corporate Physiotherapy"
4. Click "Go"

**Add Test Review:**
1. Click "testimonials" table
2. Click "Insert"
3. Fill in:
   - client_name: "Happy Client"
   - rating: "5"
   - comment: "Excellent service!"
   - status: "approved"
4. Click "Go"

### Backup Database

**Export (Backup):**
1. Click "rehab_by_raha" database
2. Click "Export" tab
3. Format: "SQL"
4. Click "Go"
5. Save the SQL file

**Import (Restore):**
1. Click "rehab_by_raha" database
2. Click "Import" tab
3. Browse and select SQL file
4. Click "Go"

### Delete Old Records

**Delete Old Appointments:**
1. Click "appointments" table
2. Click checkbox for records to delete
3. At bottom, select "Delete"
4. Confirm deletion

**Delete Old Inquiries:**
Similar process in "contact_inquiries" table

---

## 📊 Useful Queries

If you want to run custom queries:
1. Click "SQL" tab at top
2. Paste query
3. Click "Go"

**View all pending appointments:**
```sql
SELECT * FROM appointments WHERE status = 'pending' ORDER BY created_at DESC;
```

**View approved testimonials:**
```sql
SELECT * FROM testimonials WHERE status = 'approved' ORDER BY rating DESC;
```

**View all contact inquiries from last 30 days:**
```sql
SELECT * FROM contact_inquiries 
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
ORDER BY created_at DESC;
```

**Count testimonials by rating:**
```sql
SELECT rating, COUNT(*) as count FROM testimonials 
WHERE status = 'approved' 
GROUP BY rating;
```

**View experts with most recent first:**
```sql
SELECT * FROM experts ORDER BY created_at DESC;
```

---

## 🛡️ Database Maintenance

### Regular Tasks

**Weekly:**
- [ ] Review new contact inquiries
- [ ] Approve/reject pending reviews
- [ ] Check appointment status
- [ ] Update expert profiles if needed

**Monthly:**
- [ ] Export database backup
- [ ] Delete spam/unwanted inquiries
- [ ] Archive old appointments
- [ ] Review statistics

**Quarterly:**
- [ ] Full database backup
- [ ] Review and update all content
- [ ] Check for data inconsistencies
- [ ] Update services if needed

### Optimize Database

**Clean Up Old Data (Keep 1 year):**
```sql
DELETE FROM contact_inquiries 
WHERE created_at < DATE_SUB(NOW(), INTERVAL 1 YEAR);
```

**Repair Tables (If corrupted):**
1. Click "Tools" tab (if available)
2. Select "Check" or "Repair"
3. Select affected tables
4. Click "Go"

---

## ⚙️ Database Settings

### Character Set
- **UTF-8 (utf8mb4)** - Supports all languages including Hindi, Punjabi
- Already configured in `db_config.php`

### Collation
- **utf8mb4_general_ci** - Default collation
- Works perfectly for multilingual content

---

## 📈 Data Statistics Queries

**Total Appointments:**
```sql
SELECT COUNT(*) as total_appointments FROM appointments;
```

**Approved Reviews Count:**
```sql
SELECT COUNT(*) as approved_reviews FROM testimonials WHERE status = 'approved';
```

**Total Services:**
```sql
SELECT COUNT(*) as total_services FROM services;
```

**Contact Inquiries Stats:**
```sql
SELECT 
  status, 
  COUNT(*) as count 
FROM contact_inquiries 
GROUP BY status;
```

---

## 🔑 User Roles (Future Enhancement)

Once you scale the business, you might want to add:
- **Admin**: Full database access
- **Therapist**: Can view appointments and client info
- **Receptionist**: Can manage appointments and reviews
- **Client**: Can view own appointments and profile

For now, all access is through phpMyAdmin with root account.

---

## 🚨 Important Security Notes

1. **Never share phpMyAdmin URL publicly**
2. **Change default password** once setup is complete:
   - Go to User Accounts in phpMyAdmin
   - Change root password
   - Update `db_config.php` accordingly

3. **Regular backups prevent data loss**
4. **Test backups** to ensure they work

---

## 📞 When to Update Database

### Update Experts:
- When team changes
- When qualifications update
- When social media links change

### Update Services:
- When adding new services
- When modifying service descriptions
- When changing service availability

### Review Testimonials:
- Approve new reviews daily/weekly
- Reject spam or inappropriate content
- Monitor rating trends

### Track Appointments:
- Confirm bookings
- Update status as appointments complete
- Archive completed appointments

### Handle Inquiries:
- Respond to new inquiries
- Mark as read when reviewed
- Update status when replied

---

**💡 Tip**: Set a weekly reminder to check phpMyAdmin and manage your data!
