<?php
include 'config.php'; // Include your database connection file

if(isset($_POST['submit'])){
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
    
    // Query to retrieve user details based on the provided ID
    $select_user = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$search_query'") or die('Query failed');
    
    if(mysqli_num_rows($select_user) > 0){
        // User found, display their details
        $user_data = mysqli_fetch_assoc($select_user);
        $user_image = $user_data['image'] ? 'uploaded_img/' . $user_data['image'] : 'images/default-avatar.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 20px auto;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .record-item {
            margin-bottom: 10px;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Record</h1>

        <!-- Profile Picture -->
        <img src="<?php echo $user_image; ?>" alt="Profile Picture" class="profile-picture">

        <!-- Student Details -->
        <div class="record-item">
            <strong>ID:</strong> <?php echo $user_data['id']; ?>
        </div>
        <div class="record-item">
            <strong>Name:</strong> <?php echo $user_data['name']; ?>
        </div>
        <div class="record-item">
            <strong>Email:</strong> <?php echo $user_data['email']; ?>
        </div>
        <!-- Additional Fields -->
        <div class="record-item">
            <strong>Purpose:</strong> 
            <input type="text" name="purpose" placeholder="Enter Purpose">
        </div>
        <div class="record-item">
            <strong>Laboratory:</strong> 
            <input type="text" name="laboratory" placeholder="Enter Laboratory">
        </div>
        <div class="record-item">
            <strong>Sessions:</strong> 
            <input type="text" name="sessions" placeholder="Enter Sessions">
        </div>
        <br>
        <!-- Go Back Button -->
		<a href="" class="btn"><i class="fas fa-arrow-left"></i> Sit-In</a>
        <a href="homeadmin.php" class="btn"><i class="fas fa-arrow-left"></i> Go Back</a>
    </div>
</body>
</html>
<?php
    } else {
        // User not found
        header("Location: homeadmin.php?user_not_found=true");
        exit();
    }
}
?>
