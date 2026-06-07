// ============================================
// REHAB BY RAHA - JavaScript Interactivity
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize the website
    initNavbar();
    loadExperts();
    loadServices();
    loadTestimonials();
    initAppointmentForm();
    initContactForm();
    initReviewModal();
    initExpertModals();
});

// ============================================
// NAVBAR FUNCTIONALITY
// ============================================

function initNavbar() {
    const toggle = document.querySelector('.navbar-toggle');
    const menu = document.querySelector('.navbar-menu');

    if (toggle) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('active');
        });
    }

    // Close menu when clicking a link
    const links = document.querySelectorAll('.navbar-menu a');
    links.forEach(link => {
        link.addEventListener('click', function() {
            menu.classList.remove('active');
        });
    });
}

// ============================================
// NOTIFICATION SYSTEM
// ============================================

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = message;
    document.body.appendChild(notification);

    // Add active class to trigger animation
    setTimeout(() => notification.classList.add('active'), 10);

    // Remove after 5 seconds
    setTimeout(() => {
        notification.classList.remove('active');
        setTimeout(() => notification.remove(), 400);
    }, 5000);
}

// ============================================
// LOAD EXPERTS
// ============================================

function loadExperts() {
    const expertsGrid = document.getElementById('expertsGrid');
    if (!expertsGrid) return;

    fetch('php/get_data.php?action=get_experts')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.data) {
                expertsGrid.innerHTML = data.data.map(expert => {
                    const initials = expert.name.split(' ').map(n => n.charAt(0)).join('').toUpperCase();
                    return `
                    <div class="expert-card" onclick="openExpertModal(${expert.id})">
                        <div class="expert-image-container">
                            <img src="assets/images/${expert.photo_url}" alt="${expert.name}" class="expert-photo" onerror="handleImageError(this, '${initials}')" />
                        </div>
                        <div class="expert-info">
                            <h3>${expert.name}</h3>
                            <p>${expert.title}</p>
                            <div class="specialization">${expert.qualification}</div>
                            <div class="expert-socials">
                                ${expert.linkedin_url ? `<a href="${expert.linkedin_url}" target="_blank" title="LinkedIn">💼</a>` : ''}
                                ${expert.instagram_url ? `<a href="${expert.instagram_url}" target="_blank" title="Instagram">📱</a>` : ''}
                            </div>
                        </div>
                    </div>
                `}).join('');
            }
        })
        .catch(error => console.error('Error loading experts:', error));
}

function handleImageError(img, initials) {
    const container = img.parentElement;
    container.innerHTML = `<div class="expert-avatar-fallback">${initials}</div>`;
}

// ============================================
// EXPERT MODAL
// ============================================

function openExpertModal(expertId) {
    fetch(`php/get_data.php?action=get_expert&id=${expertId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const expert = data.data;
                const initials = expert.name.split(' ').map(n => n.charAt(0)).join('').toUpperCase();
                const modal = document.getElementById('expertModal');
                modal.innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="assets/images/${expert.photo_url}" alt="${expert.name}" onerror="this.parentElement.innerHTML = '<div style=\\'width: 100%; height: 100%; background: linear-gradient(135deg, #0D6B9C, #1BA09A); display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; font-weight: 700;\\'>${initials}</div>'" />
                            <button class="modal-close" onclick="closeExpertModal()">×</button>
                        </div>
                        <div class="modal-body">
                            <h2>${expert.name}</h2>
                            <p class="title">${expert.title}</p>
                            <p class="qualification"><strong>Qualifications:</strong><br>${expert.qualification}</p>
                            <p>${expert.bio}</p>
                            <div class="modal-socials">
                                ${expert.linkedin_url ? `<a href="${expert.linkedin_url}" target="_blank" title="LinkedIn">💼</a>` : ''}
                                ${expert.instagram_url ? `<a href="${expert.instagram_url}" target="_blank" title="Instagram">📱</a>` : ''}
                            </div>
                        </div>
                    </div>
                `;
                modal.classList.add('active');
            }
        })
        .catch(error => console.error('Error loading expert details:', error));
}

function closeExpertModal() {
    const modal = document.getElementById('expertModal');
    modal.classList.remove('active');
    setTimeout(() => {
        modal.innerHTML = '';
    }, 300);
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('expertModal');
    if (event.target === modal) {
        closeExpertModal();
    }
});

// ============================================
// LOAD SERVICES
// ============================================

function loadServices() {
    const servicesGrid = document.getElementById('servicesGrid');
    if (!servicesGrid) return;

    fetch('php/get_data.php?action=get_services')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.data) {
                servicesGrid.innerHTML = data.data.map(service => `
                    <div class="service-card">
                        <h3>${service.name}</h3>
                        <p>${service.description}</p>
                    </div>
                `).join('');
            }
        })
        .catch(error => console.error('Error loading services:', error));
}

// ============================================
// APPOINTMENT FORM
// ============================================

function initAppointmentForm() {
    const form = document.getElementById('appointmentForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        formData.append('action', 'book_appointment');

        fetch('php/appointments.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showNotification(data.message, 'success');
                form.reset();
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred. Please try again.', 'error');
        });
    });
}

// ============================================
// CONTACT FORM
// ============================================

function initContactForm() {
    const form = document.getElementById('contactForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('php/contact.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showNotification(data.message, 'success');
                form.reset();
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred. Please try again.', 'error');
        });
    });
}

// ============================================
// TESTIMONIALS & CAROUSEL
// ============================================

function loadTestimonials() {
    const carousel = document.getElementById('testimonialCarousel');
    if (!carousel) return;

    fetch('php/testimonials.php?action=get_testimonials')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.data) {
                carousel.innerHTML = data.data.map(testimonial => {
                    const initials = testimonial.client_name.split(' ').map(n => n[0]).join('');
                    return `
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <div class="testimonial-avatar">
                                    ${testimonial.photo_url ? `<img src="${testimonial.photo_url}" alt="${testimonial.client_name}">` : initials}
                                </div>
                                <div>
                                    <div class="testimonial-name">${testimonial.client_name}</div>
                                    <div class="testimonial-rating">${'★'.repeat(testimonial.rating)}${'☆'.repeat(5 - testimonial.rating)}</div>
                                </div>
                            </div>
                            <p class="testimonial-text">"${testimonial.comment}"</p>
                        </div>
                    `;
                }).join('');

                // Auto scroll carousel every 5 seconds
                autoScrollCarousel();
            }
        })
        .catch(error => console.error('Error loading testimonials:', error));
}

function autoScrollCarousel() {
    const carousel = document.getElementById('testimonialCarousel');
    if (!carousel || carousel.children.length === 0) return;

    setInterval(() => {
        const firstCard = carousel.children[0];
        carousel.style.transition = 'none';
        carousel.scrollLeft += firstCard.offsetWidth + 32; // card width + gap

        // Reset when reaching the end
        if (carousel.scrollLeft >= (carousel.scrollWidth - carousel.offsetWidth)) {
            carousel.scrollLeft = 0;
        }
    }, 5000);
}

// ============================================
// REVIEW MODAL
// ============================================

function initReviewModal() {
    const reviewBtn = document.getElementById('reviewBtn');
    const reviewModal = document.getElementById('reviewModal');
    const reviewForm = document.getElementById('reviewForm');
    const closeReviewBtn = document.querySelector('.review-modal-close');

    if (!reviewBtn || !reviewModal) return;

    reviewBtn.addEventListener('click', () => {
        reviewModal.classList.add('active');
    });

    closeReviewBtn.addEventListener('click', () => {
        reviewModal.classList.remove('active');
    });

    // Close when clicking outside
    reviewModal.addEventListener('click', (e) => {
        if (e.target === reviewModal) {
            reviewModal.classList.remove('active');
        }
    });

    // Star rating
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.dataset.value;
            stars.forEach(s => {
                if (s.dataset.value <= rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
            document.getElementById('reviewRating').value = rating;
        });
    });

    // Form submission
    reviewForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(reviewForm);
        formData.append('action', 'add_review');

        fetch('php/testimonials.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showNotification(data.message, 'success');
                reviewForm.reset();
                reviewModal.classList.remove('active');
                // Reload testimonials
                setTimeout(() => loadTestimonials(), 500);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred. Please try again.', 'error');
        });
    });
}

function initExpertModals() {
    // Expert modals are handled by openExpertModal and closeExpertModal
}

// ============================================
// SMOOTH SCROLL & ACTIVE LINK HIGHLIGHTING
// ============================================

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
        }
    });
});

// ============================================
// HELPER: Format phone numbers
// ============================================

function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 10) value = value.slice(0, 10);
    input.value = value;
}

// ============================================
// ACCESSIBILITY: Keyboard navigation
// ============================================

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const expertModal = document.getElementById('expertModal');
        const reviewModal = document.getElementById('reviewModal');
        
        if (expertModal && expertModal.classList.contains('active')) {
            closeExpertModal();
        }
        if (reviewModal && reviewModal.classList.contains('active')) {
            reviewModal.classList.remove('active');
        }
    }
});
