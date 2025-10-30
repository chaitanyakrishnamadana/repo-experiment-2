<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Giftly</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="checkout-container">
        <h1>Checkout</h1>
        
        <?php
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header("Location: cart.php");
            exit();
        }

        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['totalPrice'];
        }
        ?>

        <div class="checkout-grid">
            <div class="shipping-form">
                <h2>Shipping Information</h2>
                <form action="process_checkout.php" method="POST">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Street Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" required>
                        </div>

                        <div class="form-group">
                            <label for="zip">ZIP Code</label>
                            <input type="text" id="zip" name="zip" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>

                    <div class="order-summary">
                        <h3>Order Summary</h3>
                        <p>Total Items: <?php echo count($_SESSION['cart']); ?></p>
                        <p class="total">Total Price: $<?php echo number_format($total, 2); ?></p>
                    </div>

                    <button type="submit" class="cta-button">Place Order</button>
                </form>
            </div>

            <div class="order-items">
                <h2>Your Items</h2>
                <?php
                foreach ($_SESSION['cart'] as $item) {
                    echo '<div class="checkout-item">
                            <h3>' . ucfirst($item['giftType']) . '</h3>
                            <p>Custom Text: ' . htmlspecialchars($item['customText']) . '</p>
                            <p>Packaging: ' . ucfirst($item['packaging']) . '</p>
                            <p>Delivery: ' . ucfirst($item['delivery']) . '</p>
                            <p class="item-price">$' . number_format($item['totalPrice'], 2) . '</p>
                          </div>';
                }
                ?>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Giftly. All rights reserved.</p>
        </div>
    </footer>
</body>
</html> 