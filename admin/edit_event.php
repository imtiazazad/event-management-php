<?php
session_start();

include('db_connection.php');

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['user_name'];

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$event = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventID = $_GET['id'];
    
    // Fetch event details from the events table using prepared statement
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
        }
    } else {
        // Handle database query execution error
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $research = $_POST['research'];

    // Check if a new file is provided
    if ($_FILES["photo"]["name"] !== '') {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Validate and process file upload (you can add more validation)
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // File uploaded successfully

            // Update event data in the database with a new photo using a prepared statement
            $updateQuery = "UPDATE events SET title = ?, date = ?, time = ?, photo = ?, location = ?, category = ?, description = ?, research = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
$stmt->bind_param("sssssssi", $title, $date, $time, $location, $category, $description, $research, $eventID);

            if ($stmt->execute()) {
                // Event updated successfully
                header("Location: eventlist.php");
                exit();
            } else {
                // Handle database query execution error
            }
        } else {
            // Handle file upload error
        }
    } else {
        // Update event data in the database without changing the photo
        $updateQuery = "UPDATE events SET title = ?, date = ?, time = ?, location = ?, category = ?, description = ?, research = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
   $stmt->bind_param("sssssssi", $title, $date, $time, $location, $category, $description, $research, $eventID);


        if ($stmt->execute()) {
            // Event updated successfully
            header("Location: eventlist.php");
            exit();
        } else {
            // Handle database query execution error
        }
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<?php include('header.php'); ?>

<div class="container mt-4">
    <h2>Edit Event</h2>

    <?php if (isset($event)): ?>
    <form action="edit_event.php?id=<?php echo $eventID; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $event['title']; ?>" required>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $event['date']; ?>" required>
        </div>

        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" class="form-control" id="time" name="time" value="<?php echo $event['time']; ?>" required>
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
            <img src="<?php echo $event['photo']; ?>" class="mt-3" alt="<?php echo $event['title']; ?>" style="max-width: 200px;">
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location" value="<?php echo $event['location']; ?>" required>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="entertainment" <?php if ($event['category'] == 'entertainment') echo 'selected'; ?>>Entertainment</option>
                <option value="sports" <?php if ($event['category'] == 'sports') echo 'selected'; ?>>Sports</option>
                <option value="food" <?php if ($event['category'] == 'food') echo 'selected'; ?>>Food</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $event['description']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="research">Research:</label>
            <select class="form-control" id="research" name="research" required>
                <option value="sponsor" <?php if ($event['research'] == 'sponsor') echo 'selected'; ?>>Sponsor</option>
                <option value="logo" <?php if ($event['research'] == 'logo') echo 'selected'; ?>>Logo</option>
                <option value="info" <?php if ($event['research'] == 'info') echo 'selected'; ?>>Info</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>

    <!-- Back Button to Event List -->
    <a href="eventlist.php" class="btn btn-secondary mt-3">Back to Event List</a>

    <?php else: ?>
    <div class="alert alert-danger" role="alert">
        Event not found or invalid event ID.
    </div>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
