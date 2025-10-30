<?php
// Get the current page filename to determine active link
$current_page = basename($_SERVER['PHP_SELF']);

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CustomizedGift</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }

        /* Header styles */
        header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1rem 5%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #007bff;
        }

        nav a.active {
            color: #007bff;
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-actions button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            color: #333;
            transition: color 0.3s ease;
        }

        .user-actions button:hover {
            color: #007bff;
        }

        .cart-count {
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
            position: absolute;
            top: -8px;
            right: -8px;
        }

        .cart-button {
            position: relative;
        }

        /* Profile Modal Styles */
        .profile-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            backdrop-filter: blur(5px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .profile-modal.active {
            opacity: 1;
        }

        .profile-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.95);
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            border: 1px solid rgba(74, 107, 255, 0.1);
        }
        
        .profile-modal.active .profile-modal-content {
            transform: translate(-50%, -50%) scale(1);
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .profile-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(74, 107, 255, 0.1);
            position: relative;
        }

        .profile-modal-header h2 {
            margin: 0;
            color: #4a6bff;
            font-size: 1.8rem;
            font-weight: 600;
            background: linear-gradient(45deg, #4a6bff, #6c8cff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }
        
        .profile-modal-header h2::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: linear-gradient(45deg, #4a6bff, #6c8cff);
            bottom: -10px;
            left: 0;
            border-radius: 3px;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: #4a6bff;
            transition: all 0.3s ease;
            padding: 0.5rem;
            line-height: 1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .close-modal:hover {
            color: #fff;
            background-color: #4a6bff;
            transform: rotate(90deg);
        }

        .profile-info {
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid rgba(74, 107, 255, 0.1);
            box-shadow: 0 4px 12px rgba(74, 107, 255, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .profile-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(74, 107, 255, 0.1);
        }

        .profile-info p {
            margin: 0.8rem 0;
            color: #555;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .profile-info p:hover {
            transform: translateX(5px);
            background-color: rgba(74, 107, 255, 0.05);
        }

        .profile-info strong {
            color: #4a6bff;
            min-width: 80px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .profile-info strong:before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        
        .profile-info p:nth-child(1) strong:before {
            content: '\f007'; /* user icon */
        }
        
        .profile-info p:nth-child(2) strong:before {
            content: '\f0e0'; /* envelope icon */
        }

        .profile-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .profile-actions a {
            text-decoration: none;
            flex: 1;
        }

        .profile-actions button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .profile-actions button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
        }
        
        .profile-actions button:hover::before {
            left: 100%;
        }

        .logout {
            background: linear-gradient(45deg, #dc3545, #ff4d4d);
            color: white;
        }

        .logout:hover {
            background: linear-gradient(45deg, #c82333, #ff3333);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }

        .logout:active {
            transform: translateY(0);
        }

        .edit-profile {
            background: linear-gradient(45deg, #4a6bff, #6c8cff);
            color: white;
        }

        .edit-profile:hover {
            background: linear-gradient(45deg, #3a5bef, #5c7cff);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 107, 255, 0.2);
        }

        .edit-profile:active {
            transform: translateY(0);
        }

        .profile-actions button i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .profile-actions button:hover i {
            transform: translateX(3px);
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .user-actions {
                margin-top: 1rem;
            }

            .profile-modal-content {
                padding: 2rem;
                width: 95%;
            }

            .profile-info p {
                font-size: 1rem;
            }

            .profile-actions button {
                padding: 0.7rem 1.2rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="index.php" class="logo">CustomizedGift</a>
            <nav>
                <ul>
                    <li><a href="index.php" <?php echo $current_page === 'index.php' ? 'class="active"' : ''; ?>>Home</a></li>
                    <li><a href="categories.php" <?php echo $current_page === 'categories.php' ? 'class="active"' : ''; ?>>Categories</a></li>
                    <li><a href="about.php" <?php echo $current_page === 'about.php' ? 'class="active"' : ''; ?>>About</a></li>
                    <li><a href="contact.php" <?php echo $current_page === 'contact.php' ? 'class="active"' : ''; ?>>Contact</a></li>
                    <?php if($isLoggedIn): ?>
                    <li><a href="purchases.php" <?php echo $current_page === 'purchases.php' ? 'class="active"' : ''; ?>>View Purchases</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="user-actions">
                <a href="cart.php" class="cart-button">
                    <!-- <button><i class="fas fa-shopping-cart"></i></button> -->
                    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span class="cart-count"><?php echo count($_SESSION['cart']); ?></span>
                    <?php endif; ?>
                </a>
                <button id="userButton"><i class="fas fa-user"></i></button>
            </div>
        </div>
    </header>

    <!-- Profile Modal -->
    <div id="profileModal" class="profile-modal">
        <div class="profile-modal-content">
            <div class="profile-modal-header">
                <h2>Profile</h2>
                <button class="close-modal">&times;</button>
            </div>
            <?php if($isLoggedIn): ?>
                <div class="profile-info">
                    <p><strong>Name:</strong> <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Not set'; ?></p>
                    <p><strong>Email:</strong> <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Not set'; ?></p>
                </div>
                <div class="profile-actions">
                    <a href="signUpLogin/logout.php"><button class="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
                </div>
            <?php else: ?>
                <div class="profile-info">
                    <p>Please log in to view your profile.</p>
                </div>
                <div class="profile-actions">
                    <a href="signUpLogin/login.php"><button class="edit-profile"><i class="fas fa-sign-in-alt"></i> Login</button></a>
                    <a href="signUpLogin/signup.html"><button class="logout"><i class="fas fa-user-plus"></i> Sign Up</button></a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Profile Modal Functionality
        const userButton = document.getElementById('userButton');
        const profileModal = document.getElementById('profileModal');
        const closeModal = document.querySelector('.close-modal');

        userButton.addEventListener('click', () => {
            profileModal.style.display = 'block';
            // Use setTimeout to trigger the animation after the display is set
            setTimeout(() => {
                profileModal.classList.add('active');
            }, 10);
        });

        closeModal.addEventListener('click', () => {
            profileModal.classList.remove('active');
            // Hide the modal after the animation completes
            setTimeout(() => {
                profileModal.style.display = 'none';
            }, 300);
        });

        window.addEventListener('click', (e) => {
            if (e.target === profileModal) {
                profileModal.classList.remove('active');
                // Hide the modal after the animation completes
                setTimeout(() => {
                    profileModal.style.display = 'none';
                }, 300);
            }
        });
        
        // Add keyboard accessibility - close with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && profileModal.style.display === 'block') {
                profileModal.classList.remove('active');
                setTimeout(() => {
                    profileModal.style.display = 'none';
                }, 300);
            }
        });
    </script>
</body>
</html> 