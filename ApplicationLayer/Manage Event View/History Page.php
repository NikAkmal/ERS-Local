<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Controller/Event Controller.php';
$participant_id = $_SESSION['participant_id'];
$account_type = $_SESSION['account_type'];

//Prevent Access Without Log In
$account_type = $_SESSION['account_type'];
if($account_type=="None"){
  echo "<script type='text/javascript'>alert('You must login!');
    window.location='../../ApplicationLayer/Manage Login and Registration View/Login.php';
    </script>";
}

//Retrieve all event list {default}
$event_category = $_SESSION['event_category'];
// $event_category = "science";

if($event_category=="all"){
	$viewAllHistory =  new eventController();
	$data = $viewAllHistory->viewAllHistory($participant_id);
}
else{
	$viewSelectedHistory =  new eventController();
	$data = $viewSelectedHistory->viewSelectedHistory($participant_id, $event_category);
}

if(isset($_POST['Search'])){
	$event_category = $_POST['event_category'];
 	$_SESSION['event_category'] = $event_category;
 	header("Location:../../ApplicationLayer/Manage Event View/History Page.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>History Page</title>
    <?php include '../../includes/ParticipantTopNaviBar.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
  #table{
	text-align: left;
	margin-left: auto;
  margin-right: auto;
  width: 95%;
  color: black;
  background-color: #B4CFEC;
  }

  table.center {
  margin-left: auto;
  margin-right: auto;
}

table, th, td {
  border: 1px solid black;
}

#btn{
	font-weight: normal;
	color: #fff;
	background: #337ab7;
	border: none;
	border-radius: 4px;
	cursor: pointer;
}

</style>
</head>
<body>
<section>
<br>
<form method="POST" action="" style="text-align: center;">
<div class="form-row">
    <div class="col">
      <label>PAST EVENT REGISTRATION:</label>
    </div>
    <div class="col" >
	
    <label for="event_category" >Search Category: </label>
                      <select name="event_category" id="event_category">
                        <option value="all"></option>
                        <option value="all">All</option>
                        <option value="sports">Sports</option>
                        <option value="conferences">Conferences</option>
                        <option value="expos">Expos</option>
                        <option value="festival">Festival</option>
                        <option value="science">Science</option>
                        <option value="arts">Arts</option>
                        <option value="community">Community</option>
                        <option value="other">Other</option>
                      </select>
      <input type="submit" id="btn" name="Search" value="Search" />
    </div>
  </div>
</form>							
<form method= "post" action="../../ApplicationLayer/Manage Event View/Information Page.php">
	<div>
<table id="table" class="center">
	<tr>
	<th style="text-align: center;"><label>EVENT NAME</label></th>
	<th style="text-align: center;"><label>REGISTRATION TIME</label></th>
	<th style="text-align: center;"><label>REGISTRATION DATE</label></th>
	<th><label></label></th>
	</tr>									
	<?php
	foreach ($data as $row) {
	?>
		<tr>
		<td><label><?=$row['event_name']?></label></td>
		<td style="text-align: center;"><label><?=$row['registration_time']?></label></td>
		<td style="text-align: center;"><label><?=$row['registration_date']?></label></td>
		<td style="text-align: center;">
		<input id="btn" type="button" class="primary" onclick="location.href='../../ApplicationLayer/Manage Event View/Information Page.php?event_id=<?=$row['event_id']?>'"  value="INFORMATION">&nbsp</li>
		</td>
		</tr>
	<?php
		}
	?>										
</td>									
</table>
</div>
</form>
</section>

</body>
    
</html>
