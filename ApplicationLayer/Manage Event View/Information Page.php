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
	<h2 style="text-align: left;" >EVENT INFORMATION:</h2>
	<div id="frm">	
		<form action="" method="POST" enctype="multipart/form-data">
				<?php	foreach ($data as $row){	
				$_SESSION['event_qr_code'] = $row['event_qr_code'];	
				$event_request_status = $row['event_request_status'];	
				if($account_type=="organizer"){?>
					<table id="table">
				<p>
				<tr><th>
					<label>EVENT NAME:</label></th><th>
					<input type="text" id="event_name" name="event_name" value="<?=$row['event_name'];?>"	/></th></tr>
				</p>
				<p>
				<tr><th>
					<label>EVENT VENUE:</label></th><th>
					<input type="text" id="event_venue" name="event_venue" value="<?=$row['event_venue'];?>"	/></th></tr>
				</p>
				<p>
				<tr><th>
					<label>EVENT START DATE:</label></th><th>
					<input type="date" id="event_start_date" name="event_start_date" value="<?=$row['event_start_date'];?>"></th></tr>
				</p>			
				<p>
				<tr><th>
					<label>EVENT END DATE:</label></th><th>
					<input type="date" id="event_end_date" name="event_end_date" value="<?=$row['event_end_date'];?>"></th></tr>
				</p>				
				<p>
				<tr><th>
					<label >EVENT BEGIN TIME:</label></th><th>
					<input type="time" id="event_begin_time" name="event_begin_time" value="<?=$row['event_begin_time'];?>"></th></tr>
				</p>
				<p>
				<tr><th>
					<label >EVENT END TIME:</label></th><th>
					<input type="time" id="event_end_time" name="event_end_time" value="<?=$row['event_end_time'];?>"></th></tr>
				</p>			
				<p>
				<tr><th>
					<label>EVENT DETAIL:</label></th><th>
					<input type="text" id="event_detail" name="event_detail" value="<?=$row['event_detail'];?>"/></th></tr>
				</p>
				<p>
				<tr><th>
					<label for="event_category">EVENT CATEGORY:</label></th><th>
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
						</select></th></tr>
				</p>
			</table>


				<?php } else{?>
					<td><img src="<?=$row['event_poster']?>" style="width: 380px;height: 380px;"></td>
					<h3 style="text-align: center;" >EVENT TITLE:</h3>		
					<h2 style="text-align: center;" ><?=$row['event_name']?></h2>		
					<h3 style="text-align: center;" >EVENT INFORMATION:</h3>	
					<table id="table">					
						<tr>
						<td><label>EVENT VENUE:</label></td>
						<td><label><?=$row['event_venue']?></label></td>
						</tr><tr>
						<td><label>EVENT START DATE:</label></td>
						<td><label><?=$row['event_start_date']?></label></td>
						</tr><tr>
						<td><label>EVENT END DATE:</label></td>
						<td><label><?=$row['event_end_date']?></label></td>
						</tr><tr>
						<td><label>EVENT BEGIN TIME:</label></td>
						<td><label><?=$row['event_begin_time']?></label></td>
						</tr><tr>
						<td><label>EVENT END TIME:</label></td>
						<td><label><?=$row['event_end_time']?></label></td>
						</tr><tr>
						<td><label>EVENT DETAIL:</label></td>
						<td><label><?=$row['event_detail']?></label></td>
						</tr><tr>
						<td><label>EVENT CATEGORY:</label></td>
						<td><label><?=$row['event_category']?></label></td>
						</tr>
						
						<tr>
						<td><label>EVENT BROCHURE:</label></td>					
						<td>
							<a href="<?=$row['event_brochure']?>" download="<?=$row['event_name']?>">
							<img src="/Event Registration System/Images/Event Brochure/Download-Button-Transparent-Background-PNG.png" width="150px" height="50px" />
							</a></td>
						</tr>
				</table>
			<?php	}}	?>
			<p>	
				<table id="table">
				<?php	if($account_type=="participant"){	?>
					<tr>
					<th><input type="submit" id="btn" name="REGISTER" value="REGISTER" /></th>
					</tr>
				<?php	}	else{	if($account_type=="organizer"){	?>
						<tr>	
						<th><input type="submit" id="btn" name="UPDATE" value="UPDATE" /></th>
						<th><input type="submit" id="btn" name="QRCODE" value="GENERATE QR CODE" /></th>
						</tr>
				<?php	}	else{	if($account_type=="admin"){	
						if(($event_request_status=="Pending") || ($event_request_status=="DISAPPROVE")) {	?>
							<tr>	
							<th><input type="submit" id="btn" name="DISAPPROVE" value="DISAPPROVE" /></th>
							<th><input type="submit" id="btn" name="APPROVE" value="APPROVE" /></th>
							</tr>

				<?php	}}	else{	header("Location:../../ApplicationLayer/Manage Login and Registration View/Login.php");		}}}?>
				</table>

			</p>
		</form>
	</div>
</div>
</body>

</html>
