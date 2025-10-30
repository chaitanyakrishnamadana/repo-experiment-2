<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signUpLogin/login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customizedgift";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Check if purchased table exists
$table_exists = false;
$result = $conn->query("SHOW TABLES LIKE 'purchased'");
if ($result->num_rows > 0) {
    $table_exists = true;
}

// Function to get product details
function getProductDetails($conn, $product_id) {
    $product = [
        'name' => 'Product #' . $product_id,
        'image' => 'https://via.placeholder.com/120x120?text=Product'
    ];
    
    $stmt = $conn->prepare("SELECT name, image FROM products WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $product['name'] = $row['name'];
            if (!empty($row['image'])) {
                $product['image'] = $row['image'];
            }
        }
        $stmt->close();
    }
    
    return $product;
}

// Fetch all purchases for the user
if ($table_exists) {
    $query = "SELECT p.*, pr.name as product_name, pr.image as product_image, c.customizations 
              FROM purchased p 
              LEFT JOIN products pr ON p.product_id = pr.id 
              LEFT JOIN customizations c ON p.customization_id = c.id 
              WHERE p.user_id = ? 
              ORDER BY p.purchase_date DESC";
} else {
    // If purchased table doesn't exist, show empty state
    $purchases = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Purchases - CustomizedGift</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        :root {
            --primary-color: #4a6bff;
            --primary-light: #e8edff;
            --secondary-color: #6c757d;
            --accent-color: #ff6b6b;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
            --success-color: #28a745;
            --border-radius: 12px;
            --box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #333;
            line-height: 1.6;
            padding-top: 80px; /* Space for fixed navbar */
        }

        .purchases-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .purchases-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .purchases-header h1 {
            font-size: 2.5rem;
            color: var(--dark-bg);
            margin-bottom: 0.5rem;
        }

        .purchases-header p {
            color: var(--secondary-color);
            font-size: 1.1rem;
        }

        .purchases-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 3px;
        }

        .purchase-item {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: var(--transition);
            display: grid;
            grid-template-columns: 200px 1fr;
        }

        .purchase-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .purchase-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .purchase-details {
            padding: 1.5rem;
        }

        .purchase-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }

        .purchase-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-bg);
        }

        .purchase-date {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .purchase-price {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .purchase-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-left: 1rem;
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .purchase-customizations {
            margin-top: 1rem;
        }

        .customization-item {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .customization-label {
            font-weight: 600;
            margin-right: 0.5rem;
            min-width: 100px;
            color: var(--dark-bg);
        }

        .customization-value {
            color: var(--secondary-color);
        }

        .empty-purchases {
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            animation: fadeIn 0.5s ease;
        }

        .empty-purchases i {
            font-size: 5rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }

        .empty-purchases h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--dark-bg);
        }

        .empty-purchases p {
            color: var(--secondary-color);
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .continue-shopping {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(74, 107, 255, 0.3);
        }

        .continue-shopping:hover {
            background: #3a5bef;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(74, 107, 255, 0.4);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .purchase-item {
                grid-template-columns: 1fr;
            }

            .purchase-image {
                height: 200px;
            }

            .purchase-header {
                flex-direction: column;
                gap: 0.5rem;
            }

            .purchase-title {
                font-size: 1.3rem;
            }

            .purchases-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="purchases-container">
        <div class="purchases-header">
            <h1>My Purchases</h1>
            <p>View all your customized gift purchases</p>
        </div>

        <?php if ($table_exists): ?>
            <?php
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $purchases = $result->fetch_all(MYSQLI_ASSOC);
            ?>

            <?php if (count($purchases) > 0): ?>
                <?php foreach ($purchases as $purchase): ?>
                    <?php 
                    // Get product details if not already available
                    if (!isset($purchase['product_name']) || !isset($purchase['product_image'])) {
                        $product_details = getProductDetails($conn, $purchase['product_id']);
                        $product_name = $product_details['name'];
                        $product_image = $product_details['image'];
                    } else {
                        $product_name = $purchase['product_name'];
                        $product_image = $purchase['product_image'];
                    }
                    
                    // Decode customizations
                    $customization_data = json_decode($purchase['customizations'], true);
                    ?>
                    <div class="purchase-item">
                        <img src="<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product_name); ?>" class="purchase-image">
                        
                        <div class="purchase-details">
                            <div class="purchase-header">
                                <div>
                                    <h3 class="purchase-title"><?php echo htmlspecialchars($product_name); ?></h3>
                                    <div class="purchase-date">
                                        Purchased on: <?php echo date('F j, Y', strtotime($purchase['purchase_date'])); ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="purchase-price">$<?php echo number_format($purchase['total_price'], 2); ?></span>
                                    <span class="purchase-status status-<?php echo strtolower($purchase['status']); ?>">
                                        <?php echo ucfirst($purchase['status']); ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="purchase-customizations">
                                <?php if (is_array($customization_data)): ?>
                                    <?php foreach ($customization_data as $key => $value): ?>
                                        <div class="customization-item">
                                            <span class="customization-label"><?php echo ucfirst($key); ?>:</span>
                                            <span class="customization-value"><?php echo htmlspecialchars($value); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-purchases">
                    <i class="fas fa-shopping-bag"></i>
                    <h2>No purchases yet</h2>
                    <p>You haven't made any purchases yet. Browse our collection to find the perfect gift!</p>
                    <a href="categories.php" class="continue-shopping">Browse Categories</a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-purchases">
                <i class="fas fa-shopping-bag"></i>
                <h2>No purchases yet</h2>
                <p>You haven't made any purchases yet. Browse our collection to find the perfect gift!</p>
                <a href="categories.php" class="continue-shopping">Browse Categories</a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 CustomizedGift. All rights reserved.</p>
        </div>
    </footer>
</body>
</html> 