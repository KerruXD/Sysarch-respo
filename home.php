<?php

include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

    <!-- Custom CSS file link  -->
    <link rel="stylesheet" href="css/style.css">
 <style>
        
        .btn {
            background-color: var(--blue);
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin-right: 10px;
        }
		.btn:hover{
            background-color: var(--red);
        }
    </style>

</head>

<body>

<div class="container" style="background-color: white;">
  <div class="profile">
    <a href="" class="btn">Student Page</a>
    <br>
    <?php
        $select = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'") or  die('Query failed');
        if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
        }
        if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
        }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
        }
    ?>
    <p>Student ID: <?php echo $fetch['studid']; ?></p>
    <h3>Welcome, <?php echo $fetch['name']; ?>!</h3>
    <a href="update_profile.php" class="btn"><i class="fa-solid fa-pen-to-square"></i>&nbsp; Edit profile</a>
    <a href="" class="btn"><i class="fas fa-street-view"></i>&nbsp; Sit-In</a>
    <a href="" class="btn">&nbsp; View Remaining Sessions: <?php echo $fetch['remaining_sessions']; ?></a>
    <a href="" class="btn"><i class="fa-solid fa-book"></i>&nbsp; Mark Reservation</a>
    <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout &nbsp;<i class="fa-solid fa-arrow-right"></i></a>
  </div>
</div>

</body>
</html>
