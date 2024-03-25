<?php
include 'config.php';

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get the search query
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
    
    // Search for user by ID
    $search_result = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$search_query'");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        .container h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .profile-details {
            margin-top: 20px;
            text-align: center;
        }

        .profile-image img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-details input {
            width: calc(100% - 20px);
            margin-top: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .profile-details input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
        }

        .back-btn {
            margin-top: 20px;
            text-align: center;
        }

        .back-btn a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Users</h2>
        <form action="" method="post">
            <input type="text" name="search_query" placeholder="Enter User ID">
            <input type="submit" name="submit" value="Search">
        </form>
        <div class="profile-details">
            <?php
            if(isset($search_result)) {
                if(mysqli_num_rows($search_result) > 0) {
                    while($row = mysqli_fetch_assoc($search_result)) {
                        echo "<div class='profile-image'>";
                        if($row['image'] == ''){
                            echo '<img src="images/default-avatar.png">';
                        } else {
                            echo '<img src="uploaded_img/'.$row['image'].'">';
                        }
                        echo "</div>";
                        echo "<div>";
                        echo "<input type='text' value='".$row['name']."' readonly>";
                        echo "<input type='email' value='".$row['email']."' readonly>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='no-results'>No results found.</p>";
                }
            }
            ?>
            <div class="back-btn">
                <a href="homeadmin.php">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
