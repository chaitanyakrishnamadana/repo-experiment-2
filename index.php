<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftly - Personalized Gifts</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animations.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content fade-in">
                <h1>Create Personalized Gifts</h1>
                <p class="typing-effect">Make your loved ones feel special with custom-made gifts</p>
                <div class="hero-buttons">
                    <a href="categories.php" class="cta-button">Explore Categories</a>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <h2 class="fade-in">Why Choose Giftly?</h2>
            <div class="features-grid">
                <div class="feature-card slide-in-left">
                    <i class="fas fa-tag pulse"></i>
                    <h3>Smart Pricing</h3>
                    <p>Competitive prices for high-quality products</p>
                </div>
                <div class="feature-card fade-in">
                    <i class="fas fa-paint-brush float"></i>
                    <h3>Easy Customization</h3>
                    <p>Simple tools to create your perfect gift</p>
                </div>
                <div class="feature-card fade-in">
                    <i class="fas fa-truck float"></i>
                    <h3>Fast Delivery</h3>
                    <p>Quick shipping to your doorstep</p>
                </div>
                <div class="feature-card slide-in-right">
                    <i class="fas fa-award pulse"></i>
                    <h3>Quality Materials</h3>
                    <p>Premium materials for lasting gifts</p>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="testimonials">
            <h2 class="fade-in">What Our Customers Say</h2>
            <div class="testimonial-card scale-up">
                <div class="testimonial-content">
                    <p>"The custom mug I ordered was perfect! The quality exceeded my expectations, and the personalization was exactly as I wanted it."</p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Customer" class="hover-lift">
                        <div>
                            <h4>Sarah Johnson</h4>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <h2 class="fade-in glow">Ready to Create Something Special?</h2>
            <p class="fade-in">Start customizing your perfect gift today</p>
            <a href="categories.php" class="cta-button bounce-in">Browse Categories</a>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content fade-in">
            <div class="footer-links">
                <div class="footer-section slide-in-left">
                    <h3>About Giftly</h3>
                    <a href="about.php">Our Story</a>
                    <a href="#">Careers</a>
                    <a href="#">Press</a>
                </div>
                <div class="footer-section fade-in">
                    <h3>Customer Service</h3>
                    <a href="contact.php">Contact Us</a>
                    <a href="#">Shipping Info</a>
                    <a href="#">Returns</a>
                </div>
                <div class="footer-section slide-in-right">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <p class="copyright">&copy; 2024 Giftly. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="animations.js"></script>
</body>
</html>

