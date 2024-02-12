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

// Define an array to store error messages
$errors = array();

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data (add more validation as needed)
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $category = $_POST['category'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $research = $_POST['research'];

    // Handle file upload (photo)
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is a real image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    if ($_FILES["photo"]["size"] > 500000) {
        $errors[] = "File is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $errors[] = "Image upload failed.";
    } else {
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            // Insert event data into the database using prepared statement
            $insertQuery = "INSERT INTO events (title, date, time, photo, location, category, description, research) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ssssssss", $title, $date, $time, $targetFile, $location, $category, $description, $research);

            if ($stmt->execute()) {
                // Event created successfully
                header("Location: welcome.php");
                exit();
            } else {
                $errors[] = "Error creating event.";
            }
        } else {
            $errors[] = "Error uploading image.";
        }
    }
}

// Close the database connection
$conn->close();
?>

<?php include('header.php'); ?>

<div class="container mt-5">
 
    <!-- Display error messages, if any -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


        <!-- Rest of the form goes here as you have it -->
        <div class="container mt-5">
    <h2>Create Event</h2>
    <form action="createevent.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" class="form-control" id="time" name="time" required>
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control-file" id="photo" name="photo" required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="entertainment">Entertainment</option>
                <option value="sports">Sports</option>
                <option value="food">Food</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="research">Research:</label>
            <select class="form-control" id="research" name="research" required>
                <option value="sponsor">Sponsor</option>
                <option value="logo">Logo</option>
                <option value="info">Info</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
 
</div>

<?php include('footer.php'); ?>
