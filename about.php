<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Giftly</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animations.css">
    <style>
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 80px; /* Add space for fixed navbar */
        }

        .about-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .about-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .about-header p {
            color: var(--light-text);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .mission-section {
            background-color: var(--card-bg);
            padding: 3rem;
            border-radius: 15px;
            margin-bottom: 3rem;
            text-align: center;
        }

        .mission-section h2 {
            margin-bottom: 1.5rem;
        }

        .mission-section p {
            color: var(--light-text);
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .team-section {
            margin-bottom: 3rem;
        }

        .team-section h2 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-member {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .team-member h3 {
            margin-bottom: 0.5rem;
        }

        .team-member p {
            color: var(--light-text);
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-links a {
            color: var(--primary-color);
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--accent-color);
        }

        .values-section {
            margin-bottom: 3rem;
        }

        .values-section h2 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .value-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .value-card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .value-card h3 {
            margin-bottom: 1rem;
        }

        .value-card p {
            color: var(--light-text);
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="about-container">
        <div class="about-header fade-in">
            <h1>Our Story</h1>
            <p>Giftly was born from a simple idea: to make gift-giving more personal and meaningful.</p>
        </div>

        <section class="mission-section slide-in-left">
            <h2>Our Mission</h2>
            <p>We believe that the best gifts are those that tell a story. Our mission is to help you create personalized gifts that capture special moments and create lasting memories. We combine high-quality materials with innovative customization tools to make your gift-giving experience truly unique.</p>
        </section>

        <section class="team-section">
            <h2 class="fade-in">Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member scale-up">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson">
                    <h3>Sarah Johnson</h3>
                    <p>Founder & CEO</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-member scale-up">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Chen">
                    <h3>Michael Chen</h3>
                    <p>Creative Director</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-member scale-up">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez">
                    <h3>Emily Rodriguez</h3>
                    <p>Customer Experience</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="values-section">
            <h2 class="fade-in">Our Values</h2>
            <div class="values-grid">
                <div class="value-card slide-in-left">
                    <i class="fas fa-heart pulse"></i>
                    <h3>Quality</h3>
                    <p>We use only the finest materials and craftsmanship in all our products.</p>
                </div>
                <div class="value-card fade-in">
                    <i class="fas fa-lightbulb float"></i>
                    <h3>Innovation</h3>
                    <p>We constantly explore new ways to make personalization easier and more creative.</p>
                </div>
                <div class="value-card slide-in-right">
                    <i class="fas fa-handshake pulse"></i>
                    <h3>Customer Focus</h3>
                    <p>Your satisfaction is our top priority, and we're here to help every step of the way.</p>
                </div>
            </div>
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