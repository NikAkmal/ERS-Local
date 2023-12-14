<?php

//For Logout
session_start();  
session_destroy();

//Start New Session
session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Controller/Login and Registration Controller.php';

//Prevent Access Without Log In
$_SESSION['account_type'] = "None";

//Account Validation

if(isset($_POST['LOGIN'])){
	//Load all data for homepage
		$_SESSION['event_category'] = "all";
	//Report View
		$_SESSION['report_select'] = "all";
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//Get data from login function for admin
	$login = new loginRegistrationController();  
	$data = $login->AdminAccountData();
	foreach ($data as $row) {
		$usernamedb = $row['admin_username'];
		$passworddb = $row['admin_password'];

		if($username==$usernamedb){
			if($password==$passworddb){
				$_SESSION['admin_id'] = $row['admin_id'];
				$_SESSION['account_type'] = $row['account_type'];
				//User Page
				$_SESSION['user_catergory'] = "participant";
				header("Location:../../ApplicationLayer/Manage Event View/Admin Homepage.php");
			}
			else{
				$message = "Wrong password!";
				echo "<script type='text/javascript'>alert('$message');
				window.location = 'Login.php';</script>";			
			}
		}
	}

	//Get data from login function for Event Organizer
	$login = new loginRegistrationController();  
	$data = $login->EventOrganizerAccountData();
	foreach ($data as $row) {
		$usernamedb = $row['event_organizer_username'];
		$passworddb = $row['event_organizer_password'];
		$accountstatus = $row['event_organizer_account_status'];
		if($username==$usernamedb){
			if($password==$passworddb){
				if($accountstatus== "Unblacklisted"){
					$_SESSION['event_organizer_id'] = $row['event_organizer_id'];
					$_SESSION['account_type'] = $row['account_type'];
					//For Report Page
					$_SESSION['event_id'] = 0;
					//For Information Page
					$_SESSION['information'] = 0;
					header("Location:../../ApplicationLayer/Manage Event View/Event Organizer Homepage.php");
				}
				else{
					$message = "Account Banned!";
					echo "<script type='text/javascript'>alert('$message');
					window.location = 'Login.php';</script>";
				}
			}
			else{
				$message = "Wrong password!";
				echo "<script type='text/javascript'>alert('$message');
				window.location = 'Login.php';</script>";
			}
		}
	}

	//Get data from login function for Participant
	$login = new loginRegistrationController();  
	$data = $login->ParticipantAccountData();
	foreach ($data as $row) {
		$usernamedb = $row['participant_username'];
		$passworddb = $row['participant_password'];
		$accountstatus = $row['participant_account_status'];
		if($username==$usernamedb){
			if($password==$passworddb){
				if($accountstatus== "Unblacklisted"){
					$_SESSION['participant_id'] = $row['participant_id'];
					$_SESSION['account_type'] = $row['account_type'];
					header("Location:../../ApplicationLayer/Manage Event View/Participant Homepage.php");
				}
				else{
					$message = "Account Banned!";
					echo "<script type='text/javascript'>alert('$message');
					window.location = 'Login.php';</script>";
				}
			}
			else{
				$message = "Wrong password!";
				echo "<script type='text/javascript'>alert('$message');
				window.location = 'Login.php';</script>";
			}
		}
	}

	$message = "Wrong username or not yet registered!";
	echo "<script type='text/javascript'>alert('$message');
	window.location = 'Login.php';</script>";

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
	margin-left: auto;
  	margin-right: auto;
}

</style>
<body>
	<div id="frm">	
		<form method="POST" action="">
			<h2>EVENT REGISTRATION WEBSITE (ERS)</h2>
			<p>
				<label>USERNAME:</label>
				<input type="text" id="user" name="username"	required>
			</p>
			<p>
				<label>PASSWORD:</label>
				<input type="password" id="pass" name="password"	required>
			</p>
			<p>
				<table id="table">
					<tr>	
					<th><input type="submit" id="btn" name="LOGIN" value="LOGIN" /></th>
					<th><input type="button" id="btn" name="REGISTER" value="REGISTER" 
					onclick="location.href='../../ApplicationLayer/Manage Login and Registration View/Register.php'">
					</th>
					</tr>
				</table>
			</p>
		</form>
	</div>
</body>
</html>
