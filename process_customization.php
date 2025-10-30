<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customizedgift";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;
    $customizations = isset($_POST['customizations']) ? $_POST['customizations'] : [];
    $total_price = isset($_POST['total_price']) ? (float)$_POST['total_price'] : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : 'add_to_cart';
    
    // Validate inputs
    $errors = [];
    
    if ($product_id <= 0) {
        $errors[] = "Invalid product ID";
    }
    
    if (empty($customizations)) {
        $errors[] = "No customization options selected";
    }
    
    // If there are validation errors, return error message
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(", ", $errors)]);
        exit();
    }
    
    // Convert customizations array to JSON
    $customizations_json = json_encode($customizations);
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Insert customization data into database
        $stmt = $conn->prepare("INSERT INTO customizations (user_id, product_id, customizations, total_price, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iisd", $user_id, $product_id, $customizations_json, $total_price);
        
        if ($stmt->execute()) {
            // Get the ID of the inserted record
            $customization_id = $conn->insert_id;
            
            // If action is buy_now, also insert into purchased table
            if ($action === 'buy_now') {
                // Check if purchased table exists, if not create it
                $check_table = "SHOW TABLES LIKE 'purchased'";
                $table_exists = $conn->query($check_table)->num_rows > 0;
                
                if (!$table_exists) {
                    $create_table = "CREATE TABLE purchased (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        user_id INT NOT NULL,
                        product_id INT NOT NULL,
                        customization_id INT NOT NULL,
                        total_price DECIMAL(10,2) NOT NULL,
                        purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        status ENUM('success', 'completed', 'cancelled') DEFAULT 'success',
                        FOREIGN KEY (user_id) REFERENCES users(id),
                        FOREIGN KEY (product_id) REFERENCES products(id),
                        FOREIGN KEY (customization_id) REFERENCES customizations(id)
                    )";
                    $conn->query($create_table);
                } else {
                    // Update any existing purchases with 'pending' status to 'success'
                    $update_status = "UPDATE purchased SET status = 'success' WHERE status = 'pending'";
                    $conn->query($update_status);
                }
                
                // Insert into purchased table
                $insert_purchase = $conn->prepare("INSERT INTO purchased (user_id, product_id, customization_id, total_price, status) VALUES (?, ?, ?, ?, 'success')");
                $insert_purchase->bind_param("iiid", $user_id, $product_id, $customization_id, $total_price);
                $insert_purchase->execute();
                $insert_purchase->close();
                
                // Commit transaction
                $conn->commit();
                
                // Return success message with redirect
                echo json_encode([
                    'success' => true, 
                    'message' => 'Purchase completed successfully!', 
                    'customization_id' => $customization_id,
                    'redirect' => 'purchases.php'
                ]);
            } else {
                // Commit transaction
                $conn->commit();
                
                // Return success message
                echo json_encode([
                    'success' => true, 
                    'message' => 'Product added to cart successfully!', 
                    'customization_id' => $customization_id
                ]);
            }
        } else {
            throw new Exception('Error saving customization: ' . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    
    $stmt->close();
    $conn->close();
    exit();
}
?> 