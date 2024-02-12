<?php
// Include your database connection
include('admin/db_connection.php');

// Get the search query from the URL parameter
$searchQuery = $_GET['query'];

// Perform a database query based on the search query
$query = "SELECT * FROM events WHERE title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";

$result = $conn->query($query);
?>

<?php include 'header.php'; ?>

<div class="container mt-4">
    <h2>Search Results for: <?php echo $searchQuery; ?></h2>

    <div class="row">
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <a href="event_details.php?id=<?php echo $row['id']; ?>">
                            <img src="admin/<?php echo $row['photo']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12">
                <p>No events found for your search.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
// Include your footer or common elements here
include 'footer.php';
?>
