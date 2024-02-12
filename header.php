<?php
// Start a session
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS file if needed -->
    <link rel="stylesheet" href="styles.css">
    <style>
    .user-welcome {
        display: inline-block;
        color: red !important;
        font-weight: bold;
    }
</style>

</head>
<body>
        <div id="preloader">
        <div id="loader"></div>
    </div>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">NSU EVENT MANAGEMENT</a>
            <!-- ... other navbar content ... -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="admin/login.php">Admin</a>
                    </li>
                   <?php
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    echo '<li class="nav-item">';
    echo '<a class="nav-link user-welcome" href="profile.php?user_id=' . $_SESSION['user_id'] . '">Welcome, ' . $_SESSION['user_name'] . '</a>';
    echo '</li>';
} else {
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="login.php">Login</a>';
    echo '</li>';
}
?>

                </ul>
                <form class="form-inline ml-auto">
                    <input class="form-control mr-sm-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="performSearch()">Search</button>
                </form>
            </div>
        </nav>
    </header>