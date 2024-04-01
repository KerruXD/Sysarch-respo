<?php
include 'config.php'; // Include your database connection file

if(isset($_GET['id'])) {
    $record_id = $_GET['id'];
    
    // Update the Time-Out time for the corresponding sit-in record
    $update_time_out = mysqli_query($conn, "UPDATE sit_form SET time_out = NOW() WHERE id = '$record_id'");
    
    if($update_time_out) {
        // Redirect back to view.php after successful log-out
        header("Location: view.php");
        exit();
    } else {
        echo "Log-Out failed!";
    }
} else {
    echo "Invalid request!";
}
?>
