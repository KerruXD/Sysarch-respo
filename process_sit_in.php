<?php
include 'config.php';

if(isset($_POST['sit_in'])){
    $studid = $_POST['studid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $remaining_sessions = $_POST['remaining_sessions'];
    // Decrement remaining sessions
    $remaining_sessions--;

    // Update remaining sessions in the database
    mysqli_query($conn, "UPDATE user_form SET remaining_sessions = $remaining_sessions WHERE studid = '$studid'");

    // Redirect back to search_user.php or anywhere else
    header("Location: search_user.php");
    exit();
}
?>
