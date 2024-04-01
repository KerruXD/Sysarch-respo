<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Search</title>
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
    <?php
    // Check if the status query parameter is set and equals success
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        echo '<div class="success-message">User successfully deleted!</div>';
    }
    ?>

    <h2>Students Data Management</h2>

    <table>
        <tr>
			<th>Student ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php
        // Establish database connection
        $conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('Connection failed');

        // Fetch existing user data from the database
        $select_query = "SELECT studid, name, email FROM user_form";
        $result = mysqli_query($conn, $select_query) or die('Query failed');

        // Check if there are any users
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
				 echo '<td>' . $row['studid'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td><a href="delete.php?studid=' . $row['studid'] . '" class="delete-btn" onclick="return confirmDelete()">Delete</a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No users found.</td></tr>';
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </table>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this user?');
        }
    </script>
</body>
</html>