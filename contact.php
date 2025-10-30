<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Giftly</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animations.css">
    <style>
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
            margin-top: 80px;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .contact-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .contact-header p {
            color: var(--light-text);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .contact-info {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }

        .contact-info h2 {
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .info-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 1rem;
            width: 30px;
            text-align: center;
        }

        .info-item div h3 {
            margin-bottom: 0.25rem;
        }

        .info-item div p {
            color: var(--light-text);
        }

        .contact-form {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }

        .contact-form h2 {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .submit-button {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: var(--accent-color);
        }

        .faq-section {
            margin-bottom: 3rem;
        }

        .faq-section h2 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .faq-grid {
            display: grid;
            gap: 1.5rem;
        }

        .faq-item {
            background-color: var(--card-bg);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }

        .faq-item h3 {
            margin-bottom: 1rem;
        }

        .faq-item p {
            color: var(--light-text);
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="contact-container">
        <div class="contact-header fade-in">
            <h1>Contact Us</h1>
            <p>Have questions or need assistance? We're here to help!</p>
        </div>

        <div class="contact-grid">
            <div class="contact-info slide-in-left">
                <h2>Get in Touch</h2>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt pulse"></i>
                    <div>
                        <h3>Our Location</h3>
                        <p>123 Gift Street, Suite 100<br>San Francisco, CA 94105</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone pulse"></i>
                    <div>
                        <h3>Phone</h3>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope pulse"></i>
                    <div>
                        <h3>Email</h3>
                        <p>support@giftly.com</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock pulse"></i>
                    <div>
                        <h3>Business Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                    </div>
                </div>
            </div>

            <div class="contact-form slide-in-right">
                <h2>Send Us a Message</h2>
                <?php if (isset($_SESSION['contact_success'])): ?>
                    <div class="alert alert-success">
                        <?php 
                        echo $_SESSION['contact_success'];
                        unset($_SESSION['contact_success']);
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['contact_errors'])): ?>
                    <div class="alert alert-error">
                        <?php 
                        foreach ($_SESSION['contact_errors'] as $error) {
                            echo "<p>$error</p>";
                        }
                        unset($_SESSION['contact_errors']);
                        ?>
                    </div>
                <?php endif; ?>

                <form action="process_contact.php" method="POST">
                    <div class="form-group fade-in">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group fade-in">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group fade-in">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select Subject</option>
                            <option value="Order Inquiry">Order Inquiry</option>
                            <option value="Product Question">Product Question</option>
                            <option value="Customization Help">Customization Help</option>
                            <option value="Shipping Question">Shipping Question</option>
                            <option value="Returns and Refunds">Returns and Refunds</option>
                            <option value="General Question">General Question</option>
                        </select>
                    </div>
                    <div class="form-group fade-in">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="submit-button scale-up">Send Message</button>
                </form>
            </div>
        </div>

        <section class="faq-section">
            <h2 class="fade-in">Frequently Asked Questions</h2>
            <div class="faq-grid">
                <div class="faq-item bounce-in">
                    <h3>How long does shipping take?</h3>
                    <p>Standard shipping typically takes 3-5 business days. For personalized items, please allow an additional 2-3 days for customization. Express shipping options are available at checkout.</p>
                </div>
                <div class="faq-item bounce-in">
                    <h3>Can I modify or cancel my order?</h3>
                    <p>You can modify or cancel your order within 1 hour of placing it. After this time, your order enters production and cannot be changed. Please contact our customer support team immediately if you need to make changes.</p>
                </div>
                <div class="faq-item bounce-in">
                    <h3>What is your return policy?</h3>
                    <p>We accept returns within 30 days of delivery for standard items. Personalized items cannot be returned unless there is a defect in materials or workmanship. Please refer to our Returns page for complete details.</p>
                </div>
                <div class="faq-item bounce-in">
                    <h3>How do I track my order?</h3>
                    <p>Once your order ships, you'll receive a tracking number via email. You can use this number to track your package on our website or through the carrier's tracking system.</p>
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