<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickFix - Find Reliable Helpers</title>
    <link rel="stylesheet" href="landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ZvHjXoebDRUrTnKh9WKpWV/A0Amd+fjub5TkBXrPxe5F7WfDZL0slJ6a0mvg7VSN3qdpgqq2y1blz06Q8W2Y8A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="logo">
            <img src="logo.png" alt="QuickFix Logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">How It Works</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <a href="login.php" id="register-btn" class="register-btn">Register / Sign In</a>
    </header>

    <div class="hero-section">
        <div class="hero-text">
            <div class="head1">
                <h1>Your Helping Hand is Just a Click 
                <br>Away!</h1>
            </div>
            <p><strong class="find">Find Reliable Local Helpers in Minutes.</strong></p>
            <p>No more endless searching! Whether you need a plumber, painter, electrician, or handyman, QuickFix connects you with skilled professionals just 5-10 km away.</p>
            <ul>
                <li>💡 Post a Task & Get Matched Instantly!</li>
                <li>🛠️ Verified Skilled Helpers Ready to Assist!</li>
                <li>📍 Smart Location-Based Matching!</li>
            </ul>
            <a href="login.php" class="find-help-btn">Find Help Now</a>
            
        </div>
        <div class="hero-images">
            <img src="figmabg.png" alt="Helping Hand">
        </div>
    </div>
    
    <section class="about">
        <h2><span id="what">What is </span><span id="quickfix2">QuickFix?</span></h2>

        <div class="query">
            <p>Struggling to find a reliable handyman?</p>
        </div>
        <div class="face">
            <img src="face.png" alt="handyman icon">
        </div>
        <div class="query">
            <p>Need a last-minute home repair?</p>
        </div>
        <div class="no-worry">
            No worry!<br>QuickFix is here
        </div>

        <div class="about-container">
            <div class="about-box">
                <h3>Fast & Hassle-Free Matching</h3>
                <p>No long searches, just instant connections.</p>
            </div>
            <div class="about-box">
                <h3>Verified & Trusted Helpers</h3>
                <p>Ratings and reviews ensure quality service.</p>
            </div>
            <div class="about-box">
                <h3>Secure & Reliable</h3>
                <p>Chat before hiring, set expectations, and get things done!</p>
            </div>
        </div>
    </section>

    <div class="content-container">
        <div class="choose">
            <img src="choose.png" alt="QuickFix Image">
        </div>
        <div class="content-text">
            <p>QuickFix is your go-to platform to connect with skilled professionals for any job—big or small! Whether it's fixing a water leak, moving furniture, or painting a room, we make it effortless.</p>
            <h3><span class="last">🚀 Why To Choose QuickFix?</span></h3>
            <div class="space">
                <br>➡️ <b>Instant Matching</b> – Find the right expert near you within seconds.
                <br>➡️ <b>Verified Professionals</b> – Skilled workers with trusted profiles.
                <br>➡️ <b>Seamless Communication</b> – Chat directly with service providers.
                <br>➡️ <b>Secure Payments</b> – Fair pricing with transparent transactions.
            </div>
        </div>
    </div>
    
    <div class="works">
        <span class="hello">How It Works <br></span>
        <span class="fixit">Get Things Done in 4 Simple Steps!</span>
    </div>
    <div class="image-container">
        <img src="process.png" alt="QuickFix Process Flowchart">
    </div>

    <!-- Features Section -->
    <section class="features-container">
        <div class="section-header">
            <h2>Features <span class="highlight">QuickFix</span> have</h2>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Instant Task Matching</h3>
                <p>No more long searches! Get connected with local experts in <strong>seconds</strong>.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Verified & Trusted Helpers</h3>
                <p>Our skilled professionals come with <strong>ratings & reviews</strong>, ensuring top-quality service.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h3>Safe & Transparent Payments</h3>
                <p>Fair pricing with <strong>no hidden charges</strong>. Pay securely through trusted methods.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>24/7 Customer Support</h3>
                <p>Need help? Our <strong>support team is available anytime</strong> for assistance.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-form-container">
                <h2>Get In Touch</h2>
                <p>Let's connect! Whether it's a project idea, collaboration, or just a chat, we're always up for a conversation.</p>
                
                <form class="contact-form">
                    <div class="form-group">
                        <input type="text" placeholder="What's Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="send-message-btn">Send Message</button>
                </form>
            </div>
            
            <div class="contact-info-container">
                <h3>Let's Connect!</h3>
                <p>Need assistance? Want to collaborate? We're here for you!</p>
                
                <div class="contact-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p><strong>Address:</strong> Newtown, Kolkata, India</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <p><strong>Email:</strong> support@quickfix.com</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <p><strong>Phone:</strong> +91 9876543210</p>
                    </div>
                </div>
                
                <div class="social-links">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-logo">
                    <h3>QuickFix</h3>
                    <p>Your Tasks. Our Experts. Perfect Match.</p>
                </div>
                <div class="footer-links">
                    <div class="link-column">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="link-column">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Community</a></li>
                            <li><a href="#">Feedback</a></li>
                        </ul>
                    </div>
                    <div class="link-column">
                        <h4>Legal</h4>
                        <ul>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 QuickFix. All Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
        </div>
    </footer>

</body>
</html>