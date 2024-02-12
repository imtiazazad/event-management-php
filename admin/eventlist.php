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

// Fetch data from the events table
$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<?php include('header.php'); ?>

<!-- Dashboard content goes here -->
    <div class="container mt-5">
        <h2>Event List</h2>
        <!-- Create a table to display events -->
                <!-- Add a link to create a new event -->
        <a href="createevent.php" class="btn btn-success mb-4">Create New Event</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the rows and display data
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['time'] . '</td>';
                    echo '<td>' . $row['location'] . '</td>';
                    echo '<td>' . $row['category'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>';
                    echo '<a href="view_event.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">View</a> ';
                    echo '<a href="edit_event.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a> ';
                 echo '<a href="#" class="btn btn-danger btn-sm" onclick="showDeleteConfirmation(' . $row['id'] . ')">Delete</a>';

                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>


    </div>
<script>
function showDeleteConfirmation(eventId) {
    // Display a confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete this event?");

    // If the user confirms the deletion, redirect to the delete_event.php page
    if (confirmDelete) {
        window.location.href = "delete_event.php?id=" + eventId;
    }
}
</script>


<?php include('footer.php'); ?>
