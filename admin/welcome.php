<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
include('db_connection.php');

// Get user information from the session
$userName = $_SESSION['user_name'];

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<?php include('header.php'); ?>

<!-- Dashboard content goes here -->
<p>This is the dashboard content. You can add your dashboard widgets and information here.</p>

<?php include('footer.php'); ?>
