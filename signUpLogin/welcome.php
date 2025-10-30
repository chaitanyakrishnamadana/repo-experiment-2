<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../styles.css">
    <title>Welcome</title>
    <style>
        .welcome-container {
            text-align: center;
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
        }
        .user-info {
            margin: 20px 0;
            padding: 20px;
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        .logout-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }
        .logout-btn:hover {
            background-color: var(--hover-color);
        }
    </style>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    
    <div class="container welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
        <div class="user-info">
            <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p>You have successfully logged in.</p>
        </div>
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>
    
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Giftly. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>