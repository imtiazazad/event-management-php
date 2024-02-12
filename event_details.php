<?php include 'header.php'; ?>
<?php
// Include the database connection
include('admin/db_connection.php');

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

// Include your header, navigation, or other common elements here
?>

<!-- Full-width Container -->
<div class="container mt-4 mb-4">
    <h2>Event Details</h2>

    <?php if (isset($event)): ?>
    <!-- Back Button -->
    <a class="btn btn-secondary mb-3" href="index.php">Back to Events</a>

    <!-- Event Details Card -->
    <div class="card">
        <img src="admin/<?php echo $event['photo']; ?>" class="card-img-top" alt="<?php echo $event['title']; ?>">
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
    <?php else: ?>
    <div class="alert alert-danger" role="alert">
        Event not found or invalid event ID.
    </div>
    <?php endif; ?>
</div>

<?php
// Include your footer or common elements here
include 'footer.php';
?>
