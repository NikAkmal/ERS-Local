<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Controller/Login and Registration Controller.php';

//Prevent Access Without Log In
$_SESSION['account_type'] = "None";

//Account Registration
$i=0;

if(isset($_POST['SUBMIT']) && !empty($_FILES["profile_picture"]["name"])){

	$organizerUsername = new loginRegistrationController();
	$data = $organizerUsername->organizerUsername();
	foreach ($data as $row) {
		if($_POST['username'] == $row['event_organizer_username']){
			$i = 1;
			echo "<script type='text/javascript'>alert('Username has been taken');
			window.location='../../ApplicationLayer/Manage Login and Registration View/Login.php';
			</script>";
		}
	}
	
	$participantUsername = new loginRegistrationController();
	$data = $participantUsername->participantUsername();
	foreach ($data as $row) {
		if($_POST['username'] == $row['participant_username']){
			$i = 1;
			echo "<script type='text/javascript'>alert('Username has been taken');
			window.location='../../ApplicationLayer/Manage Login and Registration View/Login.php';
			</script>";
		}
	}

	if($i==0){
		$register = new loginRegistrationController();  
		$profile_picture = "/Event Registration System/Images/Profile Picture/".basename($_FILES['profile_picture']['name']);
		$target_dir = $_SERVER["DOCUMENT_ROOT"]."/Event Registration System/Images/Profile Picture/";
		$target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
		}
	
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		}
		// if everything is ok, try to upload file
		else {
			if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
				if ($_POST['account_type'] == 'participant'){
					$register->registerParticipant($profile_picture);
				}
				if ($_POST['account_type'] == 'organizer'){
					$register->registerEventOrganizer($profile_picture);
				}
			} 
			else {
			echo "Sorry, there was an error uploading your file.";
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<style>
td {
	text-align: center; 
  	vertical-align: middle;
}

.center {
	margin-left: auto;
	margin-right: auto;
}

body {
  background-color: #B4CFEC;
}

/* form */
#frm{
	text-align: center;
	border: solid grey 1px;
	width: 30%;
	border-radius: 5px;
	margin: 100px auto;
	background: white;
	padding: 50px;
}

/* button */
#btn{
	color: #fff;
	background: #337ab7;
	padding: 5px 20px;
	width: 100%;
	border: none;
	border-radius: 4px;
	cursor: pointer;
}

/* table */
#table{
	text-align: left;
	margin-left: auto;
  	margin-right: auto;
}

</style>
<body>
	<div id="frm">	
		<form action="Register.php" method="POST" enctype="multipart/form-data">
			<h2>ACCOUNT REGISTRATION FORM</h2>
			<table id="table">
				<p>
				<tr><th>
					<label>NAME:</label></th><th>
					<input type="text" id="name" name="name"	required></th></tr>
				</p>
				<p>
				<tr><th>
					<label>USERNAME:</label></th><th>
					<input type="text" id="username" name="username"	required></th></tr>
				</p>
				<p>
				<tr><th>	
					<label>PASSWORD:</label></th><th>
					<input type="password" id="password" name="password"	required></th></tr>
				</p>
				<p>
				<tr><th>
					<label>PHONE NUMBER</label></th><th>
					<input type="text" id="phone_number" name="phone_number"	required></th></tr>
				</p>
				<p>
				<tr><th>
					<label>MATRIC ID:</label></th><th>
					<input type="text" id="matric_id" name="matric_id"	required></th></tr>
				</p>
				<p>
				<tr><th>
					<label>ADDRESS:</label></th><th>
					<input type="text" id="address" name="address"	required></th></tr>
				</p>
				<p>
				<tr><th>
					<label for="account_type">ACCOUNT TYPE:</label></th><th>
						<select name="account_type" id="account_type">
							<option value="participant">Participant</option>
							<option value="organizer">Event Organizer</option>
						</select></th></tr>
				</p>
				<p>
				<tr><th>
					<label>PROFILE PICTURE:</label></th><th>
					<input type="file" name="profile_picture" required></th>
				</p>
			</tr>
			</table>
			<p>	
				<table id="table">
					<tr>
					<th><input type="button" id="btn" name="CANCEL" value="CANCEL" 
					onclick="location.href='../../ApplicationLayer/Manage Login and Registration View/Login.php'">
					</th>
					<th><input type="submit" id="btn" name="SUBMIT" value="SUBMIT" /></th>
					</tr>
				</table>
			</p>
		</form>
	</div>

</body>
</html>
