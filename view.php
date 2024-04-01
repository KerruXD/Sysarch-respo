<?php
include 'config.php';

if(isset($_POST['logout'])){
    $id = $_POST['id'];

    // Update time-out in the sit_form table
    $current_time = date('H:i:s');
    mysqli_query($conn, "UPDATE sit_form SET time_out = '$current_time' WHERE id = '$id'");

    // Redirect back to view.php or anywhere else
    header("Location: view.php");
    exit();
}

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    // Delete record from the sit_form table
    mysqli_query($conn, "DELETE FROM sit_form WHERE id = '$id'");

    // Redirect back to view.php or anywhere else
    header("Location: view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Sit-In Records</title>
    <style>
        body {
            margin: 4rem;
            font-family: Arial, sans-serif;
        }

        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h2>View Sit-In Records</h2>
    <a href="homeadmin.php" class="go-home-btn">Go Home</a>
    <?php
    // Fetch sit-in records from the database
    $query = "SELECT u.studid, u.name, u.email, s.room, s.purpose, s.time_in, s.time_out, s.id FROM user_form u LEFT JOIN sit_form s ON u.id = s.id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Room</th>
                <th>Purpose</th>
                <th>Time-In</th>
                <th>Time-Out</th>
                <th>Action</th> 
            </tr>';

        // Loop through each row of the result set
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['studid']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['room']."</td>";
            echo "<td>".$row['purpose']."</td>";
            echo "<td>".$row['time_in']."</td>";
            echo "<td>".$row['time_out']."</td>";
            echo "<td>
                    <form method='post' action='view.php'>
                        <input type='hidden' name='id' value='".$row['id']."'>
                        <button class='delete-btn' type='submit' name='logout'>Log-Out</button>
                        <button class='delete-btn' type='submit' name='delete'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo '</table>';
    } else {
        echo "No sit-in records found.";
    }
    ?>
</body>
</html>
