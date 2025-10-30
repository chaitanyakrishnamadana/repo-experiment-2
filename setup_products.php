<?php
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

// Read SQL file
$sql = file_get_contents('create_products_table.sql');

// Execute SQL
if ($conn->multi_query($sql)) {
    echo "Products table created successfully!";
} else {
    echo "Error creating products table: " . $conn->error;
}

$conn->close();
?> 