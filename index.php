<?php
// Initialize database connection
require_once 'includes/db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rehab By Raha - Professional Physiotherapy and Rehabilitation Services">
    <meta name="keywords" content="physiotherapy, rehabilitation, corporate wellness, pain management">
    <title>Rehab By Raha - Professional Rehabilitation Services</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- ============================================
         NAVBAR - Glass Morphism Design
         ============================================ -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-brand">
                <img src="assets/images/RBR Logoooo.png" alt="RBR Logo">
                <span>Rehab By Raha</span>
            </a>
            <div class="navbar-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="navbar-menu">
                <li><a href="index.php#home">HOME</a></li>
                <li><a href="index.php#about">ABOUT</a></li>
                <li><a href="index.php#services">SERVICES</a></li>
                <li><a href="index.php#experts">EXPERTS</a></li>
                <li><a href="index.php#testimonials">REVIEWS</a></li>
                <li><a href="index.php#contact">CONTACT</a></li>
            </ul>
        </div>
    </nav>

    <!-- ============================================
         HERO SECTION
         ============================================ -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Precision Rehab<br><span style="color: #1BA09A;">Lasting Results</span></h1>
            <p>Welcome to our Rehab Center — where healing begins with care. We provide professional physiotherapy services to reduce pain, improve movement, and help you live a healthier, more active life. Your recovery is our priority.</p>
            <div>
                <a href="index.php#contact" class="cta-button">Contact Us</a>
            </div>
        </div>

        <div class="appointment-form">
            <h3>📅 Book Your Appointment</h3>
            <form id="appointmentForm">
                <div class="form-group">
                    <label for="appt_name">Full Name *</label>
                    <input type="text" id="appt_name" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="appt_phone">Phone Number *</label>
                    <input type="tel" id="appt_phone" name="phone" placeholder="Enter your phone number" 
                           oninput="formatPhoneNumber(this)" required>
                </div>

                <div class="form-group">
                    <label for="appt_email">Email</label>
                    <input type="email" id="appt_email" name="email" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="appt_date">Preferred Date</label>
                    <input type="date" id="appt_date" name="preferred_date">
                </div>

                <div class="form-group">
                    <label for="appt_time">Preferred Time</label>
                    <input type="time" id="appt_time" name="preferred_time">
                </div>

                <div class="form-group">
                    <label for="appt_service">Service Type</label>
                    <select id="appt_service" name="service_type">
                        <option value="">Select a service</option>
                        <option value="Corporate Physiotherapy">Corporate Physiotherapy</option>
                        <option value="Posture Correction">Posture Correction</option>
                        <option value="Ergonomic Assessment">Ergonomic Assessment</option>
                        <option value="Neck & Back Pain">Neck & Back Pain Rehabilitation</option>
                        <option value="Home Visit">Home Visit Physiotherapy</option>
                        <option value="Sports Injury">Sports Injury Rehabilitation</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="appt_message">Message</label>
                    <textarea id="appt_message" name="message" placeholder="Tell us about your condition"></textarea>
                </div>

                <button type="submit" class="form-submit">Book Appointment</button>
            </form>
        </div>
    </section>

    <!-- ============================================
         ABOUT SECTION
         ============================================ -->
    <section id="about">
        <h2>About Us</h2>
        <p>Dedicated to providing quality physiotherapy, rehabilitation, and wellness services</p>
            <div class="about-container">
            <div class="about-content">
                <p>Rehab by Raha provides personalised physiotherapy and rehabilitation focused on measurable results. We combine evidence-based treatment, experienced clinicians, and compassionate care to help you regain mobility and confidence.</p>

                <div class="about-grid">
                    <div class="about-card">
                        <h3>🎯 Our Mission</h3>
                        <p>Deliver exceptional rehabilitation and wellness services that empower individuals to recover, improve, and thrive.</p>
                    </div>

                    <div class="about-card">
                        <h3>👁️ Our Vision</h3>
                        <p>To be a trusted leader in rehabilitation and corporate wellness, enabling people to move better and live pain-free.</p>
                    </div>

                    <div class="about-card">
                        <h3>💡 Our Values</h3>
                        <p>Patient-centered care, professional excellence, innovation, compassion, and continuous learning guide everything we do.</p>
                    </div>
                </div>

                <div class="about-stats">
                    <div class="stat"><strong>10+</strong><span>Years Experience</span></div>
                    <div class="stat"><strong>5000+</strong><span>Patients Treated</span></div>
                    <div class="stat"><strong>98%</strong><span>Patient Satisfaction</span></div>
                </div>
            </div>
            <div class="about-image">
                <img src="assets/images/RehabByRaha_Background.jpeg" alt="Rehab By Raha" onerror="if(this.src.indexOf('.jpeg')>-1){this.src='assets/images/RehabByRaha_Background.jpg';}else if(this.src.indexOf('.jpg')>-1){this.src='assets/images/RehabByRaha_Background.png';}else{this.src='https://via.placeholder.com/600x400?text=Rehab+By+Raha';}" />
            </div>
        </div>
    </section>

    <!-- ============================================
         SERVICES SECTION
         ============================================ -->
    <section id="services">
        <h2>Our Services</h2>
        <p>Comprehensive rehabilitation and wellness solutions tailored to your needs</p>
        <div class="services-grid" id="servicesGrid">
            <!-- Services will be loaded via JavaScript -->
            <div class="service-card">
                <h3>Loading...</h3>
                <p>Please wait while we load our services.</p>
            </div>
        </div>
    </section>

    <!-- ============================================
         EXPERTS SECTION
         ============================================ -->
    <section id="experts">
        <h2>Your Recovery Experts</h2>
        <p>Meet our team of highly qualified rehabilitation professionals</p>
        <div class="experts-grid" id="expertsGrid">
            <!-- Experts will be loaded via JavaScript -->
            <div class="expert-card">
                <div class="expert-image" style="background: linear-gradient(135deg, #0D6B9C, #1BA09A); display: flex; align-items: center; justify-content: center;">
                    <p style="color: white;">Loading...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Expert Modal -->
    <div id="expertModal" class="modal"></div>

    <!-- ============================================
         TESTIMONIALS SECTION
         ============================================ -->
    <section id="testimonials">
        <h2>Client Reviews</h2>
        <p>Real stories from our satisfied clients</p>
        <div class="testimonials-container">
            <div class="carousel-track" id="testimonialCarousel">
                <!-- Testimonials will be loaded via JavaScript -->
                <div class="testimonial-card">
                    <p>Loading reviews...</p>
                </div>
            </div>
            <button id="reviewBtn" class="review-button">➕ Add Your Review</button>
        </div>
    </section>

    <!-- Review Modal -->
    <div id="reviewModal" class="review-modal">
        <div class="review-modal-content">
            <button class="review-modal-close" onclick="document.getElementById('reviewModal').classList.remove('active')">×</button>
            <h2>Share Your Experience</h2>
            <form id="reviewForm">
                <div class="form-group">
                    <label for="reviewName">Your Name *</label>
                    <input type="text" id="reviewName" name="client_name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label>Your Rating *</label>
                    <div class="rating-input" id="ratingStars">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <input type="hidden" id="reviewRating" name="rating" value="5" required>
                </div>

                <div class="form-group">
                    <label for="reviewComment">Your Review *</label>
                    <textarea id="reviewComment" name="comment" placeholder="Share your experience with us..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="reviewPhoto">Your Photo (Optional)</label>
                    <input type="file" id="reviewPhoto" name="photo" accept="image/*">
                    <small>Max size: 5MB. Supported formats: JPG, PNG, GIF</small>
                </div>

                <button type="submit" class="form-submit">Submit Review</button>
            </form>
        </div>
    </div>

    <!-- ============================================
         CONTACT SECTION
         ============================================ -->
    <section id="contact">
        <h2>Get In Touch</h2>
        <p>We're here to help you on your journey to better health</p>
        <div class="contact-wrapper">
            <div class="contact-info">
                <div class="contact-item">
                    <h3>📞 Phone</h3>
                    <p><a href="tel:+919876543210">+91 98765 43210</a></p>
                </div>

                <div class="contact-item">
                    <h3>📧 Email</h3>
                    <p><a href="mailto:rehabbyraha@gmail.com">rehabbyraha@gmail.com</a></p>
                </div>

                <div class="contact-item">
                    <h3>📍 Location</h3>
                    <p>Delhi, India</p>
                </div>

                <div class="contact-item">
                    <h3>🕐 Working Hours</h3>
                    <p>Monday - Friday: 9:00 AM - 7:00 PM<br>Saturday: 10:00 AM - 6:00 PM<br>Sunday: Closed</p>
                </div>

                <div class="contact-item">
                    <h3>🌐 Follow Us</h3>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <a href="https://www.facebook.com/share/1DoVs4s2rd/" target="_blank" style="display: inline-block; width: 40px; height: 40px; background: #0D6B9C; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">f</a>
                        <a href="https://www.instagram.com/rehab.byraha" target="_blank" style="display: inline-block; width: 40px; height: 40px; background: #0D6B9C; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">📷</a>
                        <a href="https://www.linkedin.com/in/rehab-by-raha-75875340a" target="_blank" style="display: inline-block; width: 40px; height: 40px; background: #0D6B9C; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">in</a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3>Send us a Message</h3>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="contact_name">Your Name *</label>
                        <input type="text" id="contact_name" name="name" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="contact_email">Email *</label>
                        <input type="email" id="contact_email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="contact_phone">Phone</label>
                        <input type="tel" id="contact_phone" name="phone" placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="contact_subject">Subject *</label>
                        <input type="text" id="contact_subject" name="subject" placeholder="What is this about?" required>
                    </div>

                    <div class="form-group">
                        <label for="contact_message">Message *</label>
                        <textarea id="contact_message" name="message" placeholder="Your message here..." required></textarea>
                    </div>

                    <button type="submit" class="form-submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- ============================================
         FOOTER
         ============================================ -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <div class="footer-links">
                    <a href="index.php#home">Home</a>
                    <a href="index.php#about">About</a>
                    <a href="index.php#services">Services</a>
                    <a href="index.php#experts">Experts</a>
                    <a href="index.php#testimonials">Reviews</a>
                    <a href="index.php#contact">Contact</a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="footer-socials">
                    <a href="https://www.facebook.com/share/1DoVs4s2rd/" target="_blank" title="Facebook" class="social-icon facebook">f</a>
                    <a href="https://www.instagram.com/rehab.byraha" target="_blank" title="Instagram" class="social-icon instagram">📷</a>
                    <a href="https://www.linkedin.com/in/rehab-by-raha-75875340a" target="_blank" title="LinkedIn" class="social-icon linkedin">in</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Rehab By Raha. All rights reserved.</p>
            <p>Built with ❤️ for your health and wellness</p>
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>
