<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS file if needed -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Custom CSS for the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px;
            text-align: left;
            text-decoration: none;
            font-size: 18px;
            color: #000;
            display: block;
        }

        .sidebar a:hover {
            background-color: #d3d3d3;
        }

        /* Custom CSS for the main content */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Custom CSS for the sidebar */
.logout-form {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #f8f9fa;
    padding-top: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.logout-form a {
    padding: 10px;
    text-align: left;
    text-decoration: none;
    font-size: 18px;
    color: #000;
    display: block;
}

.logout-form a:hover {
    background-color: #d3d3d3;
}

/* Logout button styling */
.logout-form {
    padding: 5px;
    text-align: center;
}

.logout-form button {
    width: 100%;
    margin-top: 5px;
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar m-2">
        <!-- Display user information in the sidebar -->
        <p>Welcome, <?php echo $userName; ?></p>
        <a href="../index.php">Home</a>
        <a href="eventlist.php">Events</a>
        
        <!-- Logout button -->
        <form method="post">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
