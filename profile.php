<?php
// Start a session
session_start();

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check for the user_id query parameter
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Include your database connection
    include('admin/db_connection.php');

    // Fetch user details based on user_id
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        // Handle the case where the user doesn't exist
        echo "User not found.";
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the user_id is not provided in the query parameters
    echo "User ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS file if needed -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?php echo $user['photo']; ?>" class="img-fluid" alt="User Photo">
                        </div>
                        <h5 class="card-title">User Details</h5>
                        <p class="card-text"><strong>Name:</strong> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                        <p class="card-text"><strong>Email:</strong> <?php echo $user['email']; ?></p>
                        <p class="card-text"><strong>Department:</strong> <?php echo $user['department']; ?></p>
                        <a href="index.php" class="btn btn-primary">Back to Home</a>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
