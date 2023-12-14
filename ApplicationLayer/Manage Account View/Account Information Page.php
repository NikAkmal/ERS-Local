<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Controller/Account Controller.php';

//Prevent Access Without Log In
$account_type = $_SESSION['account_type'];
if($account_type=="None"){
  echo "<script type='text/javascript'>alert('You must login!');
    window.location='../../ApplicationLayer/Manage Login and Registration View/Login.php';
    </script>";
}

if ($account_type == "participant"){
	$participant_id  = $_SESSION['participant_id'];
	$user_catergory = "none";
	$viewSelectedParticipant = new accountController();
	//Obtain Participant Data  
	$data = $viewSelectedParticipant->viewSelectedParticipant($participant_id);
}
if ($account_type == "admin"){
	//Obtain Data from User Page
	$admin_id  = $_SESSION['admin_id'];
	$user_catergory = $_SESSION['user_catergory'];
	if($user_catergory=="participant"){
		$participant_id = $_GET['participant_id'];
		$viewSelectedParticipant = new accountController();
		//Obtain Participant Data  
		$data = $viewSelectedParticipant->viewSelectedParticipant($participant_id);
	}
	else {
		$event_organizer_id = $_GET['event_organizer_id'];
		$viewSelectedOrganizer = new accountController();
		//Obtain Event Organizer Data
		$data = $viewSelectedOrganizer->viewSelectedOrganizer($event_organizer_id);
	}
}
if ($account_type == "organizer"){
	$event_organizer_id  = $_SESSION['event_organizer_id'];
	$information = $_SESSION['information'];
	
	$user_catergory = "none";
	//For Organizer to obtain participant information
	if($information == "1"){
		// $participant_id = $_GET['participant_id'];
		$participant_id = $_SESSION['participant_id'];
		$viewSelectedParticipant = new accountController();
		$data = $viewSelectedParticipant->viewSelectedParticipant($participant_id);
	}
	if($information == "0"){
		$viewSelectedOrganizer = new accountController();
		//Obtain Event Organizer Data
		$data = $viewSelectedOrganizer->viewSelectedOrganizer($event_organizer_id);
	}
}

//Button
if(isset($_POST['EDIT'])){
	if($account_type=="participant"){
		$updateParticipantAccountData = new accountController();  
		$updateParticipantAccountData->updateParticipantAccountData($participant_id);
	}
	if($account_type=="organizer"){
		$updateOrganizerAccountData = new accountController();  
		$updateOrganizerAccountData->updateOrganizerAccountData($event_organizer_id);
	}
}

if(isset($_POST['UNBLACKLIST'])){
	if($user_catergory=="participant"){
		$participant_account_status = "Unblacklisted";
		$participantAccountStatus = new accountController();  
		$participantAccountStatus->participantAccountStatus($participant_id, $participant_account_status);
	}
	if($user_catergory=="organizer"){
		$event_organizer_account_status = "Unblacklisted";
		$organizerAccountStatus = new accountController();  
		$organizerAccountStatus->organizerAccountStatus($event_organizer_id, $event_organizer_account_status);
	}
}

if(isset($_POST['BLACKLIST'])){
	if($user_catergory=="participant"){
		$participant_account_status = "Blacklist";
		$participantAccountStatus = new accountController();  
		$participantAccountStatus->participantAccountStatus($participant_id, $participant_account_status);
	}
	if($user_catergory=="organizer"){
		$event_organizer_account_status = "Blacklist";
		$organizerAccountStatus = new accountController();  
		$organizerAccountStatus->organizerAccountStatus($event_organizer_id, $event_organizer_account_status);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Account Information</title>
	<?php 
		if($account_type== "admin"){
			include '../../includes/AdminTopNaviBar.php';
		}
		if($account_type== "organizer"){
			include '../../includes/EventOrganizerTopNaviBar.php';
		}
		if($account_type== "participant"){
			include '../../includes/ParticipantTopNaviBar.php';
		}
	?>
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
  background-color: white;
}

/* form */
#frm{
	text-align: center;
	border: solid grey 1px;
	width: 95%;
	height: 100%;
	border-radius: 5px;
	margin: 25px auto;
	background: white;
	padding: 50px;
}

/* button */
#btn{
	font-weight: normal;
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
	<div>
	<h2 style="text-align: center;" >ACCOUNT INFORMATION:</h2>
	<div id="frm">	
		<form action="" method="POST" enctype="multipart/form-data">
				<?php	foreach ($data as $row){
				//Edit Organizer Account Data	
				//information
				if($account_type=="organizer"){
					//For Organizer to obtain participant information
					if($information==1){
						//Reset
						$_SESSION['information'] = 0;
					?>
						<td><img src="<?=$row['participant_profile_picture']?>" style="width: 380px;height: 380px;"></td>
						<table id="table">					
							<tr>
							<td><label>NAME:</label></td>
							<td><label><?=$row['participant_name']?></label></td>
							</tr><tr>
							<td><label>USERNAME:</label></td>
							<td><label><?=$row['participant_username']?></label></td>
							</tr><tr>
							<td><label>PHONE NUMBER:</label></td>
							<td><label><?=$row['participant_phone_number']?></label></td>
							</tr><tr>
							<td><label>MATRIC ID:</label></td>
							<td><label><?=$row['participant_matric_id']?></label></td>
							</tr><tr>
							<td><label>ADDRESS:</label></td>
							<td><label><?=$row['participant_address']?></label></td>
							</tr><tr>
							<td><label>ACCOUNT TYPE:</label></td>
							<td><label><?=$row['account_type']?></label></td>
							</tr>
						</table>
					<?php } 
					else { ?>
						<td><img src="<?=$row['event_organizer_profile_picture']?>" style="width: 380px;height: 380px;"></td>
						<table id="table">
						<p>
						<tr><th>
							<label>NAME:</label></th><th>
							<input type="text" id="event_organizer_name" name="event_organizer_name" value="<?=$row['event_organizer_name'];?>"	/></th></tr>
						</p>
						<p>
						<tr><th>
							<label>USERNAME:</label></th><th>
							<input type="text" id="event_organizer_username" name="event_organizer_username" value="<?=$row['event_organizer_username'];?>"	/></th></tr>
						</p>
						<p>
						<tr><th>
							<label>PASSWORD:</label></th><th>
							<input type="password" id="event_organizer_password" name="event_organizer_password" value="<?=$row['event_organizer_password'];?>"></th></tr>
						</p>			
						<p>
						<tr><th>
							<label>PHONE NUMBER:</label></th><th>
							<input type="text" id="event_organizer_phone_number" name="event_organizer_phone_number" value="<?=$row['event_organizer_phone_number'];?>"></th></tr>
						</p>				
						<p>
						<tr><th>
							<label >ADDRESS:</label></th><th>
							<input type="text" id="event_organizer_address" name="event_organizer_address" value="<?=$row['event_organizer_address'];?>"></th></tr>
						</p>
						</table>
						<p>	
							<table id="table">
								<tr>	
									<th><input type="submit" id="btn" name="EDIT" value="EDIT" /></th>
								</tr>
							</table>
						</p>
				<?php } }
				//Edit Participant Account Data	
				if($account_type=="participant"){?>
					<td><img src="<?=$row['participant_profile_picture']?>" style="width: 380px;height: 380px;"></td>
					<table id="table">
					<p>
					<tr><th>
						<label>NAME:</label></th><th>
						<input type="text" id="participant_name" name="participant_name" value="<?=$row['participant_name'];?>"	/></th></tr>
					</p>
					<p>
					<tr><th>
						<label>USERNAME:</label></th><th>
						<input type="text" id="participant_username" name="participant_username" value="<?=$row['participant_username'];?>"	/></th></tr>
					</p>
					<p>
					<tr><th>
						<label>PASSWORD:</label></th><th>
						<input type="password" id="participant_password" name="participant_password" value="<?=$row['participant_password'];?>"></th></tr>
					</p>			
					<p>
					<tr><th>
						<label>PHONE NUMBER:</label></th><th>
						<input type="text" id="participant_phone_number" name="participant_phone_number" value="<?=$row['participant_phone_number'];?>"></th></tr>
					</p>
					<p>
					<tr><th>
						<label >MATRIC ID:</label></th><th>
						<input type="text" id="participant_matric_id" name="participant_matric_id" value="<?=$row['participant_matric_id'];?>"></th></tr>
					</p>				
					<p>
					<tr><th>
						<label >ADDRESS:</label></th><th>
						<input type="text" id="participant_address" name="participant_address" value="<?=$row['participant_address'];?>"></th></tr>
					</p>
					</table>
					<p>	
						<table id="table">
							<tr>	
								<th><input type="submit" id="btn" name="EDIT" value="EDIT" /></th>
							</tr>
						</table>
					</p>
				<?php } 

				//Admin view Organizer Account Data
				if($user_catergory=="organizer"){?>
					<td><img src="<?=$row['event_organizer_profile_picture']?>" style="width: 380px;height: 380px;"></td>
					<table id="table">					
						<tr>
						<td><label>NAME:</label></td>
						<td><label><?=$row['event_organizer_name']?></label></td>
						</tr><tr>
						<td><label>USERNAME:</label></td>
						<td><label><?=$row['event_organizer_username']?></label></td>
						</tr><tr>
						<td><label>PHONE NUMBER:</label></td>
						<td><label><?=$row['event_organizer_phone_number']?></label></td>
						</tr><tr>
						<td><label>ADDRESS:</label></td>
						<td><label><?=$row['event_organizer_address']?></label></td>
						</tr><tr>
						<td><label>ACCOUNT TYPE:</label></td>
						<td><label><?=$row['account_type']?></label></td>
						</tr>
						<td><label>ACCOUNT STATUS:</label></td>
						<td><label><?=$row['event_organizer_account_status']?></label></td>
						</tr>
				</table>
				<p>	
					<table id="table">
						<tr>	
							<th><input type="submit" id="btn" name="UNBLACKLIST" value="UNBLACKLIST" /></th>
							<th><input type="submit" id="btn" name="BLACKLIST" value="BLACKLIST" /></th>
						</tr>
					</table>
				</p>
				
				<?php } 

				//Admin view Participant Account Data
				if($user_catergory=="participant"){?>
					<td><img src="<?=$row['participant_profile_picture']?>" style="width: 380px;height: 380px;"></td>
					<table id="table">					
						<tr>
						<td><label>NAME:</label></td>
						<td><label><?=$row['participant_name']?></label></td>
						</tr><tr>
						<td><label>USERNAME:</label></td>
						<td><label><?=$row['participant_username']?></label></td>
						</tr><tr>
						<td><label>PHONE NUMBER:</label></td>
						<td><label><?=$row['participant_phone_number']?></label></td>
						</tr><tr>
						<td><label>MATRIC ID:</label></td>
						<td><label><?=$row['participant_matric_id']?></label></td>
						</tr><tr>
						<td><label>ADDRESS:</label></td>
						<td><label><?=$row['participant_address']?></label></td>
						</tr><tr>
						<td><label>ACCOUNT TYPE:</label></td>
						<td><label><?=$row['account_type']?></label></td>
						</tr>
						<td><label>ACCOUNT STATUS:</label></td>
						<td><label><?=$row['participant_account_status']?></label></td>
						</tr>
				</table>
				<p>	
					<table id="table">
						<tr>	
							<th><input type="submit" id="btn" name="UNBLACKLIST" value="UNBLACKLIST" /></th>
							<th><input type="submit" id="btn" name="BLACKLIST" value="BLACKLIST" /></th>
						</tr>
					</table>
				</p>
				
			<?php	}}	?>
		</form>
	</div>
</div>
</body>

</html>
