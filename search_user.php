	<?php
	include 'config.php'; // Include your database connection file

	if(isset($_POST['submit'])){
		$search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
		
		// Query to retrieve user details based on the provided ID
		$select_user = mysqli_query($conn, "SELECT * FROM user_form WHERE studid = '$search_query'") or die('Query failed');
		
		if(mysqli_num_rows($select_user) > 0){
			// User found, display their details
			$user_data = mysqli_fetch_assoc($select_user);
			$user_image = $user_data['image'] ? 'uploaded_img/' . $user_data['image'] : 'images/default-avatar.png';

			// Retrieve remaining sessions value from the user_data array
			$remaining_sessions = $user_data['remaining_sessions'];

			// Check if purpose and room are set
			if(isset($_POST['purpose']) && isset($_POST['room'])){
				// Insert into sit_form table
				$purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
				$room = mysqli_real_escape_string($conn, $_POST['room']);
				$time_in = date('Y-m-d H:i:s');
				$insert_sit = mysqli_query($conn, "INSERT INTO sit_form (id, sit_in_date, room, time_in, purpose) VALUES ('{$user_data['id']}', CURDATE(), '$room', '$time_in', '$purpose')") or die(mysqli_error($conn));
				
				if($insert_sit){
					// Decrement remaining sessions
					$remaining_sessions--;
					mysqli_query($conn, "UPDATE user_form SET remaining_sessions = $remaining_sessions WHERE studid = '$search_query'");
					
					// Redirect to view.php
					header("Location: view.php?success=true");
					exit();
				} else {
					// Error handling
					header("Location: homeadmin.php?error=true");
					exit();
				}
			} else {
				// Fields not set
				echo "Purpose and Room fields are required.";
			}
		} else {
			// User not found
			header("Location: homeadmin.php?user_not_found=true");
			exit();
		}
	}
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
				<strong>Student ID:</strong> <?php echo $user_data['studid']; ?>
			</div>
			<div class="record-item">
				<strong>Name:</strong> <?php echo $user_data['name']; ?>
			</div>
			<div class="record-item">
				<strong>Email:</strong> <?php echo $user_data['email']; ?>
			</div>
			
			<!-- Additional Fields -->
			<form method="post" action="search_user.php">
				<div class="form-group">
					<label for="purpose">Purpose:</label>
					<select id="purpose" name="purpose" required>
						<option value="C#">C#</option>
						<option value="Java">Java</option>
						<option value="PHP">PHP</option>
						<option value="Others">Others</option>
					</select>
				</div>
				
				<div class="form-group">
					<label for="room">Room:</label>
					<select id="room" name="room" required>
						<option value="526">526</option>
						<option value="539">539</option>
						<option value="540">540</option>
						<option value="537">537</option>
					</select>
				</div>
				
				<!-- Display remaining sessions here -->
				<div class="record-item">
				   <strong>Remaining Sessions:</strong> <?php echo $remaining_sessions; ?>
			   </div>

				<input type="hidden" name="search_query" value="<?php echo $search_query; ?>">
				
				<button type="submit" name="submit">Submit</button>
			</form>
		</div>
	</body>
	</html>
