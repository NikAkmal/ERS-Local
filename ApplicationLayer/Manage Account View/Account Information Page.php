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
#table {
        width: 80%;
        margin: auto;
        border-collapse: collapse;
        margin-top: 20px;
    }

    #table th,
    #table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    #table th {
        background-color: #337ab7;
        color: white;
        font-weight: bold;
    }

    #table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #table a {
        text-decoration: none;
        color: #33title7ab7;
    }

    #table img {
        width: 100px;
        height: 35px;
        border: none;
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
						<th style="text-align: center;">
						<img src="<?=$row['participant_profile_picture']?>" style="width: 250px; height: 250px; border-radius: 50%;">
						</th>

						<table id="table">					
							<tr>
							<th><label>NAME:</label></th>
							<td><label><?=$row['participant_name']?></label></td>
							</tr>
							<tr>
							<th><label>USERNAME:</label></th>
							<td><label><?=$row['participant_username']?></label></td>
							</tr><tr>
							<th><label>PHONE NUMBER:</label></th>
							<td><label><?=$row['participant_phone_number']?></label></td>
							</tr><tr>
							<th><label>MATRIC ID:</label></th>
							<td><label><?=$row['participant_matric_id']?></label></td>
							</tr><tr>
							<th><label>ADDRESS:</label></th>
							<td><label><?=$row['participant_address']?></label></td>
							</tr><tr>
							<th><label>ACCOUNT TYPE:</label></th>
							<td><label><?=$row['account_type']?></label></td>
							</tr>
						</table>
					<?php } 
					else { ?>
						<th style="text-align: center;">
						<img src="<?=$row['event_organizer_profile_picture']?>" style="width: 250px; height: 250px; border-radius: 50%;">
						</th>

						<table id="table">
						
						<tr><th>
							<label>NAME:</label></th><td>
							<textarea id="event_organizer_name" name="event_organizer_name"><?=$row['event_organizer_name'];?></textarea>
						</tr></td>
						
						<tr><th>
							<label>USERNAME:</label></th><td>
							<textarea id="event_organizer_username" name="event_organizer_username"><?=$row['event_organizer_username'];?></textarea>
						</th></td>
												
						<tr><th>
							<label>PASSWORD:</label></th><td>
							<input type="password" id="event_organizer_password" name="event_organizer_password" value="<?=$row['event_organizer_password'];?>">
						</th></td>
															
						<tr><th>
							<label>PHONE NUMBER:</label></th><td>
							<textarea id="event_organizer_phone_number" name="event_organizer_phone_number"><?=$row['event_organizer_phone_number'];?></textarea>
						</th></td>
										
						<tr><th>
							<label >ADDRESS:</label></th><td>
							<textarea id="event_organizer_address" name="event_organizer_address"><?=$row['event_organizer_address'];?></textarea>
						</th></td>
						
						</table>
							
							<table id="table">
								<tr>	
									<td><input type="submit" id="btn" name="EDIT" value="EDIT" /></td>
								</tr>
							</table>
						
				<?php } }
				//Edit Participant Account Data	
				if($account_type=="participant"){?>
					<th style="text-align: center;">
					<img src="<?=$row['participant_profile_picture']?>" style="width: 250px; height: 250px; border-radius: 50%;">
					</th>

					<table id="table">
					
					<tr><th>
						<label>NAME:</label></th><td>
						<textarea id="participant_name" name="participant_name"><?=$row['participant_name'];?></textarea>
					</th></td>
									
					<tr><th>
						<label>USERNAME:</label></th><td>
						<textarea id="participant_username" name="participant_username"><?=$row['participant_username'];?></textarea>
					</th></td>
										
					<tr><th>
						<label>PASSWORD:</label></th><td>
						<input type="password" id="participant_password" name="participant_password" value="<?=$row['participant_password'];?>">
					</th></td>
													
					<tr><th>
						<label>PHONE NUMBER:</label></th><td>
						<textarea id="participant_phone_number" name="participant_phone_number"><?=$row['participant_phone_number'];?></textarea>
					</th></td>
										
					<tr><th>
						<label >MATRIC ID:</label></th><td>
						<textarea id="participant_matric_id" name="participant_matric_id"><?=$row['participant_matric_id'];?></textarea>
					</th></td>
											
					<tr><th>
						<label >ADDRESS:</label></th><td>
						<textarea id="participant_address" name="participant_address"><?=$row['participant_address'];?></textarea>
					</th></td>
					
					</table>
						
						<table id="table">
							<tr>	
								<td><input type="submit" id="btn" name="EDIT" value="EDIT" /></td>
							</tr>
						</table>
					
				<?php } 

				//Admin view Organizer Account Data
				if($user_catergory=="organizer"){?>
					<th style="text-align: center;">
					<img src="<?=$row['event_organizer_profile_picture']?>" style="width: 250px; height: 250px; border-radius: 50%;">
					</th>
					<table id="table">					
						<tr>
						<th><label>NAME:</label></th>
						<td><label><?=$row['event_organizer_name']?></label></td>
						</tr><tr>
						<th><label>USERNAME:</label></th>
						<td><label><?=$row['event_organizer_username']?></label></td>
						</tr><tr>
						<th><label>PHONE NUMBER:</label></th>
						<td><label><?=$row['event_organizer_phone_number']?></label></td>
						</tr><tr>
						<th><label>ADDRESS:</label></th>
						<td><label><?=$row['event_organizer_address']?></label></td>
						</tr><tr>
						<th><label>ACCOUNT TYPE:</label></th>
						<td><label><?=$row['account_type']?></label></td>
						</tr>
						<th><label>ACCOUNT STATUS:</label></th>
						<td><label><?=$row['event_organizer_account_status']?></label></td>
						</tr>
				</table>
					
					<table id="table">
						<tr>	
							<td><input type="submit" id="btn" name="UNBLACKLIST" value="UNBLACKLIST" /></td>
							<td><input type="submit" id="btn" name="BLACKLIST" value="BLACKLIST" /></td>
						</tr>
					</table>
				
				
				<?php } 

				//Admin view Participant Account Data
				if($user_catergory=="participant"){?>
					<th style="text-align: center;">
					<img src="<?=$row['participant_profile_picture']?>" style="width: 250px; height: 250px; border-radius: 50%;">
					</th>
					<table id="table">					
						<tr>
						<th><label>NAME:</label></th>
						<td><label><?=$row['participant_name']?></label></td>
						</tr><tr>
						<th><label>USERNAME:</label></th>
						<td><label><?=$row['participant_username']?></label></td>
						</tr><tr>
						<th><label>PHONE NUMBER:</label></th>
						<td><label><?=$row['participant_phone_number']?></label></td>
						</tr><tr>
						<th><label>MATRIC ID:</label></th>
						<td><label><?=$row['participant_matric_id']?></label></td>
						</tr><tr>
						<th><label>ADDRESS:</label></th>
						<td><label><?=$row['participant_address']?></label></td>
						</tr><tr>
						<th><label>ACCOUNT TYPE:</label></th>
						<td><label><?=$row['account_type']?></label></td>
						</tr>
						<th><label>ACCOUNT STATUS:</label></th>
						<td><label><?=$row['participant_account_status']?></label></td>
						</tr>
				</table>
					
					<table id="table">
						<tr>	
							<td><input type="submit" id="btn" name="UNBLACKLIST" value="UNBLACKLIST" /></td>
							<td><input type="submit" id="btn" name="BLACKLIST" value="BLACKLIST" /></td>
						</tr>
					</table>
				
				
			<?php	}}	?>
		</form>
	</div>
</div>
</body>

</html>
