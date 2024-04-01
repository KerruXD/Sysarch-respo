<?php
include 'config.php';

if(isset($_POST['logout'])){
    $studid = $_POST['studid'];

    // Update time-out in the database
    $current_time = date('H:i:s');
    mysqli_query($conn, "UPDATE user_form SET time_out = '$current_time' WHERE studid = '$studid'");

    // Redirect back to view.php or anywhere else
    header("Location: view.php");
    exit();
}
?>
