<?php
// Include the database connection
include('db_connection.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventID = $_GET['id'];

    // Delete the event from the database
    $deleteQuery = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $eventID);

    if ($stmt->execute()) {
        // Event deleted successfully
        header("Location: eventlist.php");
        exit();
    } else {
        // Handle any errors, such as the event not found
        echo "Error deleting event: " . $stmt->error;
    }
} else {
    // Invalid or missing event ID, you can handle this case (e.g., redirect or display an error)
    echo "Invalid event ID.";
}

// Close the database connection
$conn->close();
?>
