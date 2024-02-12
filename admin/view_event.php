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


// Check if the event ID query parameter is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventID = $_GET['id'];

    // Fetch event details from the events table
    $sql = "SELECT * FROM events WHERE id = $eventID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Event details found, fetch the data
        $event = $result->fetch_assoc();
    } else {
        // Event not found, you can handle this case (e.g., display a message)
    }
} else {
    // Invalid or missing event ID, you can handle this case (e.g., redirect or display an error)
}
?>

<?php include('header.php'); ?>

<div class="container mt-4">
    <h2>Event Details</h2>

    <?php if (isset($event)): ?>
    <!-- Event Details Card -->
    <div class="card">
        <img src="uploads/<?php echo $event['photo']; ?>" class="card-img-top" alt="<?php echo $event['title']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $event['title']; ?></h5>
            <p class="card-text"><?php echo $event['description']; ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Date: <?php echo $event['date']; ?></li>
            <li class="list-group-item">Time: <?php echo $event['time']; ?></li>
            <li class="list-group-item">Location: <?php echo $event['location']; ?></li>
            <li class="list-group-item">Category: <?php echo ucfirst($event['category']); ?></li>
            <li class="list-group-item">Research: <?php echo ucfirst($event['research']); ?></li>
        </ul>
        <div class="card-footer">
            <small class="text-muted">Posted on <?php echo date('F j, Y', strtotime($event['date'])); ?></small>
        </div>
    </div>

    <!-- Back Button to Event List -->
    <a href="eventlist.php" class="btn btn-primary mt-3">Back to Event List</a>

    <?php else: ?>
    <div class="alert alert-danger" role="alert">
        Event not found or invalid event ID.
    </div>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
