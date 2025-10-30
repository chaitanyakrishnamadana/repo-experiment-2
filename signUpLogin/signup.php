<?php
session_start();

// If user is already logged in, redirect to welcome page
if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
// ... existing code ... 