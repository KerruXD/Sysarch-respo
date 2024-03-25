<?php

include 'configs.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:loginadmin.php');
};

if(isset($_GET['logout'])){
   unset($admin_id);
   session_destroy();
   header('location:loginadmin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
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
   <a href="" class="btn">Admin Page</a>
   <br>
   
      <?php
	  
         $select = mysqli_query($conn, "SELECT * FROM admin_form WHERE id = '$admin_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3> Welcome, <?php echo $fetch['name']; ?>!</h3>

		<form action="search_user.php" method="post">
    <input type="text" name="search_query" placeholder="Enter User ID">
    <input type="submit" name="submit" value="Search">
</form>
      <a href="update_profileadmin.php" class="btn"><i class="fa-solid fa-pen-to-square"></i>&nbsp Edit profile</a>
	  
	  <a href="deletestud.php" class="btn"><i class="fa-solid fa-trash"></i>&nbsp Delete</a>
	  <a href="view.php" class="btn"><i class="fa-solid fa-book"></i></i>&nbsp View Sit-In Records</a>
	  <a href="" class="btn"><i class="fa-solid fa-flag"></i>&nbsp Generate Report</a>
	  
	  
      <a href="homeadmin.php?logout=<?php echo $admin_id; ?>" class="delete-btn">Logout &nbsp<i class="fa-solid fa-arrow-right"></i></a> 
      
   </div>

</div>

</body>
</html>