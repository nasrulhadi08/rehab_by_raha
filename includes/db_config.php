<?php
// Database Configuration
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (empty)
$dbname = "rehab_by_raha";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Select database, create if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    die(json_encode(['status' => 'error', 'message' => 'Error creating database: ' . $conn->error]));
}

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Error connecting to database: ' . $conn->connect_error]));
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");

// Create tables if they don't exist
$sql_tables = "
-- Appointments Table
CREATE TABLE IF NOT EXISTS appointments (
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

-- Testimonials/Reviews Table
CREATE TABLE IF NOT EXISTS testimonials (
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

-- Experts Table
CREATE TABLE IF NOT EXISTS experts (
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

-- Services Table
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact Inquiries Table
CREATE TABLE IF NOT EXISTS contact_inquiries (
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
";

// Execute table creation
foreach (explode(";", $sql_tables) as $table_sql) {
    $table_sql = trim($table_sql);
    if (!empty($table_sql)) {
        if ($conn->query($table_sql . ";") === FALSE) {
            error_log("Error creating table: " . $conn->error);
        }
    }
}

// Insert default experts data
$experts_data = array(
    array('Raghib Raza', 'Founder & Director', 'BPT, Founder & Director of REHAB BY RAHA', 
          'I\'m Raghib Raza the Founder & Director of REHAB BY RAHA — a company built with the vision of redefining rehabilitation and healthcare through innovation, technology, and human connection.',
          'Raghib_RBR.jpeg', 'https://www.linkedin.com/in/raghib-raza-275817315', 'https://www.instagram.com/_raghib_raza_'),
    array('Shivani Upneja', 'Co-Founder & Partner', 'MBA, Co-Founder & Partner',
          'Shivani Upneja is the Co-Founder & Partner of REHAB BY RAHA. As a visionary leader, she contributes to building a brand focused on innovation, wellness, and impactful rehabilitation solutions.',
          'Shivani_RBR.jpeg', 'https://www.linkedin.com/in/shivani-upneja-49a6173a5', 'https://www.instagram.com'),
    array('Dr. Abizar Rangwala', 'Senior Physiotherapist', 'PhD Scholar, MPT Orthopedics, Associate Professor',
          'Dr. Abizar Rangwala (PT) is a dedicated physiotherapist with expertise in musculoskeletal and orthopedic rehabilitation. He holds an MPT in Orthopedics and is pursuing his PhD.',
          'Dr.Abizar_RBR.jpeg', 'https://www.linkedin.com', 'https://www.instagram.com'),
    array('Md Nasrul Hadi', 'Web Developer', 'Full Stack Developer',
          'I am a passionate web developer dedicated to creating modern, responsive, and user-friendly websites. I specialize in turning ideas into clean and functional digital experiences.',
          '1778564254425.jpg', 'https://www.linkedin.com/in/md-nasrul-hadi-350848357', 'https://www.instagram.com')
);

$check_experts = $conn->query("SELECT COUNT(*) as count FROM experts");
$experts_count = $check_experts->fetch_assoc()['count'];

if ($experts_count == 0) {
    $stmt = $conn->prepare("INSERT INTO experts (name, title, qualification, bio, photo_url, linkedin_url, instagram_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($experts_data as $expert) {
        $stmt->bind_param("sssssss", $expert[0], $expert[1], $expert[2], $expert[3], $expert[4], $expert[5], $expert[6]);
        $stmt->execute();
    }
    $stmt->close();
}

// Insert default services
$services_data = array(
    array('Corporate Physiotherapy', 'Professional physiotherapy services for corporate employees and desk workers', 'briefcase'),
    array('Posture Correction', 'Specialized programs to improve and correct your posture', 'spine'),
    array('Ergonomic Assessment', 'Comprehensive assessment of your workspace setup', 'desktop'),
    array('Neck & Back Pain Rehabilitation', 'Expert treatment for chronic and acute neck and back pain', 'pain'),
    array('Home Visit Physiotherapy', 'Convenient in-home physiotherapy sessions', 'home'),
    array('Sports Injury Rehabilitation', 'Specialized rehab for athletes and sports-related injuries', 'sports')
);

$check_services = $conn->query("SELECT COUNT(*) as count FROM services");
$services_count = $check_services->fetch_assoc()['count'];

if ($services_count == 0) {
    $stmt = $conn->prepare("INSERT INTO services (name, description, icon) VALUES (?, ?, ?)");
    foreach ($services_data as $service) {
        $stmt->bind_param("sss", $service[0], $service[1], $service[2]);
        $stmt->execute();
    }
    $stmt->close();
}
?>
