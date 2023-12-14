<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Controller/Event Controller.php';

//Prevent Access Without Log In
$account_type = $_SESSION['account_type'];
if($account_type=="None"){
  echo "<script type='text/javascript'>alert('You must login!');
    window.location='../../ApplicationLayer/Manage Login and Registration View/Login.php';
    </script>";
}

if ($account_type == "participant"){
	$participant_id  = $_SESSION['participant_id'];
}
if ($account_type == "admin"){
	$admin_id  = $_SESSION['admin_id'];
}
if ($account_type == "organizer"){
	$event_organizer_id  = $_SESSION['event_organizer_id'];
}

$event_id = $_GET['event_id'];

$viewSelectedEvent = new eventController();  

//View selected event information
$data = $viewSelectedEvent->viewSelectedEvent($event_id);

if(isset($_POST['REGISTER'])){
	$_SESSION['event_id'] = $event_id;
	header("Location:../../ApplicationLayer/Manage Event View/QR Code Scanner.php");
}

if(isset($_POST['DISAPPROVE'])){
	$event_request_status = "DISAPPROVE";
	$eventRequestStatus = new eventController();  
	$eventRequestStatus->eventRequestStatus($event_id, $admin_id, $event_request_status);
}

if(isset($_POST['APPROVE'])){
	$event_request_status = "APPROVE";
	$eventRequestStatus = new eventController();  
	$eventRequestStatus->eventRequestStatus($event_id, $admin_id, $event_request_status);
}

if(isset($_POST['UPDATE'])){
	$updateEventDetail = new eventController();  
	$updateEventDetail->updateEventDetail($event_id);
}

if(isset($_POST['QRCODE'])){
	$_SESSION['event_id'] = $event_id;
	header("Location:../../ApplicationLayer/Manage Event View/Event QR Code Generator.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Event Information</title>
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
	<h2 style="text-align: center;" >EVENT INFORMATION:</h2>
	<div id="frm">	
		<form action="" method="POST" enctype="multipart/form-data">
				<?php	foreach ($data as $row){	
				$_SESSION['event_qr_code'] = $row['event_qr_code'];	
				$event_request_status = $row['event_request_status'];	
				if($account_type=="organizer"){?>
				<table id="table">
				
				<tr>
					<th><label>EVENT NAME:</label></th><td>
					<textarea id="event_name" name="event_name"><?=$row['event_name'];?></textarea></td>
				</tr>
								
				<tr>
					<th><label>EVENT VENUE:</label></th><td>
					<input type="text" id="event_venue" name="event_venue" value="<?=$row['event_venue'];?>"	/></td>
				</tr>
								
				<tr>
					<th><label>EVENT START DATE:</label></th><td>
					<input type="date" id="event_start_date" name="event_start_date" value="<?=$row['event_start_date'];?>"></td>
				</tr>	
				
				<tr>
					<th><label>EVENT END DATE:</label></th><td>
					<input type="date" id="event_end_date" name="event_end_date" value="<?=$row['event_end_date'];?>"></td>
				</tr>
								
				<tr>
					<th><label >EVENT BEGIN TIME:</label></th><td>
					<input type="time" id="event_begin_time" name="event_begin_time" value="<?=$row['event_begin_time'];?>"></td>
				</tr>
				
				<tr>
					<th><label >EVENT END TIME:</label></th><td>
					<input type="time" id="event_end_time" name="event_end_time" value="<?=$row['event_end_time'];?>"></td>
				</tr>
							
				<tr>
					<th><label>EVENT DETAIL:</label></th><td>
					<textarea id="event_detail" name="event_detail"><?=$row['event_detail'];?></textarea></td>
				</tr>
				
				<tr>
					<th><label for="event_category">EVENT CATEGORY:</label></th><td>
						<select name="event_category" id="event_category">
							<option value="<?=$row['event_category'];?>"><?=$row['event_category'];?></option>
							<option value="sports">Sports</option>
							<option value="conferences">Conferences</option>
							<option value="expos">Expos</option>
							<option value="festival">Festival</option>
							<option value="science">Science</option>
							<option value="arts">Arts</option>
							<option value="community">Community</option>
							<option value="other">Other</option>
						</select></td></tr>
				
			</table>


				<?php } else{?>
					<img src="<?=$row['event_poster']?>" style="width: 380px; height: 380px; display: block; margin-left: auto; margin-right: auto;">
					<h3 style="text-align: center;" >EVENT INFORMATION:</h3>	
					<table id="table">
						<tr>
							<th>EVENT TITLE</th>
							<td><?=$row['event_name']?></td>
						</tr>
						<tr>
							<th>EVENT VENUE</th>
							<td><?=$row['event_venue']?></td>
						</tr>
						<tr>
							<th>EVENT START DATE</th>
							<td><?=$row['event_start_date']?></td>
						</tr>
						<tr>
							<th>EVENT END DATE</th>
							<td><?=$row['event_end_date']?></td>
						</tr>
						<tr>
							<th>EVENT BEGIN TIME</th>
							<td><?=$row['event_begin_time']?></td>
						</tr>
						<tr>
							<th>EVENT END TIME</th>
							<td><?=$row['event_end_time']?></td>
						</tr>
						<tr>
							<th>EVENT DETAIL</th>
							<td><?=$row['event_detail']?></td>
						</tr>
						<tr>
							<th>EVENT CATEGORY</th>
							<td><?=$row['event_category']?></td>
						</tr>
						<tr>
							<th>EVENT BROCHURE</th>
							<td>
								<a href="<?=$row['event_brochure']?>" download="<?=$row['event_name']?>">
									<img src="/Event Registration System/Images/Event Brochure/Download-Button-Transparent-Background-PNG.png" alt="Download" />
								</a>
							</td>
						</tr>
					</table>

			<?php	}}	?>
				
				<table id="table">
				<?php	if($account_type=="participant"){	?>
					<tr>
					<td><input type="submit" id="btn" name="REGISTER" value="REGISTER" /></td>
					</tr>
				<?php	}	else{	if($account_type=="organizer"){	?>
						<tr>	
						<td><input type="submit" id="btn" name="UPDATE" value="UPDATE" /></td>
						<td><input type="submit" id="btn" name="QRCODE" value="GENERATE QR CODE" /></td>
						</tr>
				<?php	}	else{	if($account_type=="admin"){	
						if(($event_request_status=="Pending") || ($event_request_status=="DISAPPROVE")) {	?>
							<tr>	
							<td><input type="submit" id="btn" name="DISAPPROVE" value="DISAPPROVE" /></td>
							<td><input type="submit" id="btn" name="APPROVE" value="APPROVE" /></td>
							</tr>

				<?php	}}	else{	header("Location:../../ApplicationLayer/Manage Login and Registration View/Login.php");		}}}?>
				</table>

			
		</form>
	</div>
</div>
</body>

</html>
