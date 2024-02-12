<?php
// Include your database connection
include('admin/db_connection.php');

// Initialize variables for messages
$message = '';
$messageType = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data (add more validation as needed)
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // File upload handling
    $photoDir = 'admin/uploads/'; // Directory to store uploaded photos

    if (!empty($_FILES['photo']['name'])) {
        $photoName = basename($_FILES['photo']['name']);
        $targetFile = $photoDir . $photoName;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            // File uploaded successfully
        } else {
            $message = "Error uploading photo.";
            $messageType = "danger";
        }
    }

    // Check if the email is already in use
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email is already in use
        $message = "Email is already registered. Please use a different email.";
        $messageType = "danger";
    } else {
        // Email is not in use, proceed to insert the user into the database
        $insertQuery = "INSERT INTO users (first_name, last_name, email, department, password, photo) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $department, $password, $targetFile);

        if ($stmt->execute()) {
            // User created successfully
            $message = "User registered successfully!";
            $messageType = "success";
        } else {
            // Error creating user
            $message = "Error registering user.";
            $messageType = "danger";
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS file if needed -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Custom CSS for centering the form */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="center-container">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <!-- Display Bootstrap message here -->
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" enctype="multipart/form-data"> <!-- Add enctype for file upload -->
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department" placeholder="Enter your department" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">Profile Photo</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </form>
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
