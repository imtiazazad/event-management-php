
<?php include 'header.php'; ?>
<?php
// Include the database connection
include('admin/db_connection.php');

// Fetch the last three rows from the events table
$sql = "SELECT * FROM events ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);

?>
    <!-- Preloader -->
<div class="custom-loader"></div>

    <!-- Your page content -->
<!-- Full-width Container -->
<div class="container mt-4">
    <h2>Upcoming Events</h2>

    <?php
    // Loop through the last three rows and display them
    while ($row = $result->fetch_assoc()) {
        ?>
        <!-- Event -->
        <div class="row mb-4">
            <div class="col-md-4">
                <!-- Wrap the image and title in a link to the event details page with query parameters -->
                <a href="event_details.php?id=<?php echo $row['id']; ?>">
                    <img src="admin/<?php echo $row['photo']; ?>" class="img-fluid" alt="<?php echo $row['title']; ?>" style="height: 300px;">
                </a>
            </div>
            <div class="col-md-8" style="height: 300px; overflow: hidden;">
                <div class="card h-100">
                    <div class="card-body">
                        <!-- Wrap the title and description in a link to the event details page with query parameters -->
                        <a href="event_details.php?id=<?php echo $row['id']; ?>">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        </a>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Date: <?php echo $row['date']; ?> | Time: <?php echo $row['time']; ?></small>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>


<?php
$categories = ['entertainment', 'food', 'sports'];

foreach ($categories as $category) {
    $sql = "SELECT * FROM events WHERE category = '$category' ORDER BY date DESC";
    $result = $conn->query($sql);
?>

<!-- Full-width Container -->
<div class="container mt-4">
    <h2><?php echo ucfirst($category); ?> Events</h2>

    <div class="row">
        <?php
        // Loop through the events and display them
        while ($row = $result->fetch_assoc()) {
        ?>
        <!-- Event -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Wrap the image in a link to the event details page with query parameters -->
                <a href="event_details.php?id=<?php echo $row['id']; ?>">
                    <img src="admin/<?php echo $row['photo']; ?>" class="card-img-top img-hover" alt="<?php echo $row['title']; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Date: <?php echo $row['date']; ?> | Time: <?php echo $row['time']; ?></small>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
}
?>



<?php
// Fetch all events from the events table ordered by date in descending order
$sql = "SELECT * FROM events ORDER BY date DESC";
$result = $conn->query($sql);

?>

<!-- Full-width Container -->
<div class="container mt-8">
    <h2>All Events</h2>

    <div class="row">
        <?php
        // Loop through the events and display them
        while ($row = $result->fetch_assoc()) {
        ?>
        <!-- Event -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <a href="event_details.php?id=<?php echo $row['id']; ?>"> <!-- Link to details page -->
                    <img src="admin/<?php echo $row['photo']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Date: <?php echo $row['date']; ?> | Time: <?php echo $row['time']; ?></small>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>


</script>

<?php include 'footer.php'; ?>