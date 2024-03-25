<?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('Connection failed');

// Check if ID parameter is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare delete query
    $delete_query = "DELETE FROM user_form WHERE id = $id";

    // Execute delete query
    if (mysqli_query($conn, $delete_query)) {
        // Redirect to search.php with success query parameter
        header('Location: search.php?status=success');
        exit;
    } else {
        echo 'Error deleting user: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid request.';
}

// Close database connection
mysqli_close($conn);
?>