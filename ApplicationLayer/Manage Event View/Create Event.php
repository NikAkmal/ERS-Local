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

$event_organizer_id  = $_SESSION['event_organizer_id'];

//Account Information Reset
$_SESSION['information'] = 0;

//Upload Event Poster
if(isset($_POST['REQUEST']) && !empty($_FILES["event_poster"]["name"])){
	$create = new eventController();  
	$event_poster = "/Event Registration System/Images/Event Poster/".basename($_FILES['event_poster']['name']);
	$target_dir = $_SERVER["DOCUMENT_ROOT"]."/Event Registration System/Images/Event Poster/";
	$target_file = $target_dir . basename($_FILES["event_poster"]["name"]);
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
		if (move_uploaded_file($_FILES["event_poster"]["tmp_name"], $target_file)) {
			//Upload Event Brochure
			if(!empty($_FILES["event_brochure"]["name"])){

				$event_brochure = "/Event Registration System/Images/Event Brochure/".basename($_FILES['event_brochure']['name']);
				$target_dir = $_SERVER["DOCUMENT_ROOT"]."/Event Registration System/Images/Event Brochure/";
				$target_file = $target_dir . basename($_FILES["event_brochure"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				}
				// if everything is ok, try to upload file
				else {
					if (move_uploaded_file($_FILES["event_brochure"]["tmp_name"], $target_file)) {
							$create->createEvent($event_organizer_id, $event_poster, $event_brochure);
					} 
					else {
					echo "Sorry, there was an error uploading your brochure.";
					}
				}
			}
		} 
		else {
		echo "Sorry, there was an error uploading your poster.";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Create Event</title>
	<?php include '../../includes/EventOrganizerTopNaviBar.php';?>
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
	<h2 style="text-align: center;" >CREATE EVENT FORM</h2>
	<div id="frm">	
		<form action="" method="POST" enctype="multipart/form-data">
			
			<table id="table">
				
				<tr><th>
					<label>EVENT NAME:</label></th><td>
					<textarea id="event_name" name="event_name" required></textarea></td>
				</tr>
				
				<tr><th>
					<label>EVENT VENUE:</label></th><td>
					<input type="text" id="event_venue" name="event_venue"	required></td>
				</tr>
				
				<tr><th>
					<label>EVENT START DATE:</label></th><td>
					<input type="date" id="event_start_date" name="event_start_date" required></td>
				</tr>		
				
				<tr><th>
					<label>EVENT END DATE:</label></th><td>
					<input type="date" id="event_end_date" name="event_end_date" 	required></td>
				</tr>		
				
				<tr><th>
					<label >EVENT BEGIN TIME:</label></th><td>
					<input type="time" id="event_begin_time" name="event_begin_time"	required></td>
				</tr>
				
				<tr><th>
					<label >EVENT END TIME:</label></th><td>
					<input type="time" id="event_end_time" name="event_end_time"	required></td>
				</tr>
				
				<tr><th>
					<label>EVENT DETAIL:</label></th><td>
					<textarea id="event_detail" name="event_detail" required></textarea></td>
				</tr>
								
				<tr><th>
					<label>EVENT POSTER:</label></th><td>
					<input type="file" name="event_poster" required></td>
				</tr>
				
				<tr><th>
					<label>EVENT BROCHURE:</label></th><td>
					<input type="file" name="event_brochure" required></td>
				</tr>
				
				<tr><th>
					<label for="event_category">EVENT CATEGORY:</label></th><td>
						<select name="event_category" id="event_category">
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
				
				<table id="table">
					<tr>
					<td><input type="button" id="btn" name="CANCEL" value="CANCEL" 
					onclick="location.href='../../ApplicationLayer/Manage Event View/Event Organizer Homepage.php'">
					</td>
					<td><input type="submit" id="btn" name="REQUEST" value="REQUEST" /></th>
					</td>
				</table>
			
		</form>
	</div>
</div>
</body>

</html>
