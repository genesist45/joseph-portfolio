<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <link rel="stylesheet" href="assets/css/project.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <!-- Header -->
    <?php include_once "components/header.html"; ?>
    
    <!-- Main Content -->
    <main>
        <!-- Home Section -->
        <section id="home" class="home-section">
            <div class="hero">
                <div class="profile-container scale-in">
                    <div class="profile-frame">
                        <img src="assets/img/profile.jpg" alt="Profile Image" class="profile-image">
                        <div class="profile-decoration"></div>
                    </div>
                </div>
                <div class="hero-content">
                    <span class="hero-greeting fade-in">Hello, I'm</span>
                    <h1 class="fade-in delay-100">Josep Sernicula</h1>
                    <div class="hero-title fade-in delay-200">
                        <span class="hero-title-text">Web Developer & Designer</span>
                        <span class="hero-title-decoration"></span>
                    </div>
                    <p class="hero-description fade-in delay-300">Crafting beautiful, responsive websites with modern technologies</p>
                    <div class="hero-buttons fade-in delay-400">
                        <a href="#contact" class="home-button primary-button">Get in Touch</a>
                        <a href="#projects" class="home-button secondary-button">View My Work</a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- About Section -->
        <?php include_once "components/about.html"; ?>
        
        <!-- Projects Section -->
        <?php include_once "components/project.html"; ?>
        
        <!-- Contact Section -->
        <?php include_once "components/contact.html"; ?>
    </main>
    
    <!-- Footer -->
    <?php include_once "components/footer.html"; ?>
    
    <!-- JavaScript for animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll animation function
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    // If element is in viewport
                    if (elementPosition < windowHeight - 100) {
                        element.classList.add('active');
                    }
                });
            };
            
            // Run once on load
            setTimeout(animateOnScroll, 300);
            
            // Add scroll event listener
            window.addEventListener('scroll', animateOnScroll);
            
            // Handle contact form if it exists
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                const submitBtn = document.getElementById('submitBtn');
                const submitText = document.getElementById('submitText');
                const loadingSpinner = document.getElementById('loadingSpinner');
                const toast = document.getElementById('toast');
                const toastTitle = document.getElementById('toastTitle');
                const toastDescription = document.getElementById('toastDescription');
                const toastClose = document.getElementById('toastClose');
                
                // Form data state
                let formData = {
                    name: '',
                    email: '',
                    message: ''
                };
                
                // Track submission state
                let isSubmitting = false;
                
                // Toast function
                function showToast({ title, description, variant = 'default' }) {
                    toastTitle.textContent = title;
                    toastDescription.textContent = description;
                    toast.className = `toast ${variant}`;
                    toast.style.display = 'flex';
                    
                    // Auto hide after 5 seconds
                    setTimeout(() => {
                        toast.style.display = 'none';
                    }, 5000);
                }
                
                // Close toast on click
                if (toastClose) {
                    toastClose.addEventListener('click', () => {
                        toast.style.display = 'none';
                    });
                }
                
                // Update form data on input
                const nameInput = document.getElementById('name');
                const emailInput = document.getElementById('email');
                const messageInput = document.getElementById('message');
                
                if (nameInput) {
                    nameInput.addEventListener('input', (e) => {
                        formData.name = e.target.value;
                    });
                }
                
                if (emailInput) {
                    emailInput.addEventListener('input', (e) => {
                        formData.email = e.target.value;
                    });
                }
                
                if (messageInput) {
                    messageInput.addEventListener('input', (e) => {
                        formData.message = e.target.value;
                    });
                }
                
                // Form submission handler
                contactForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    if (!formData.name || !formData.email || !formData.message) {
                        showToast({
                            title: "Please fill in all fields",
                            description: "All fields are required to submit the form.",
                            variant: "destructive"
                        });
                        return;
                    }
                    
                    isSubmitting = true;
                    submitText.style.display = 'none';
                    loadingSpinner.style.display = 'inline-block';
                    submitBtn.disabled = true;
                    
                    try {
                        // Replace this URL with your actual Formspree form ID
                        const response = await fetch("https://formspree.io/f/", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                name: formData.name,
                                email: formData.email,
                                message: formData.message
                            })
                        });
                        
                        if (response.ok) {
                            showToast({
                                title: "Message sent!",
                                description: "Thank you for your message. I'll get back to you soon."
                            });
                            // Reset form
                            contactForm.reset();
                            formData = {
                                name: '',
                                email: '',
                                message: ''
                            };
                        } else {
                            throw new Error("Failed to send message");
                        }
                    } catch (error) {
                        showToast({
                            title: "Failed to send message",
                            description: "There was a problem sending your message. Please try again later.",
                            variant: "destructive"
                        });
                        console.error("Error sending message:", error);
                    } finally {
                        isSubmitting = false;
                        submitText.style.display = 'inline-block';
                        loadingSpinner.style.display = 'none';
                        submitBtn.disabled = false;
                    }
                });
            }
        });
    </script>
</body>
</html> 