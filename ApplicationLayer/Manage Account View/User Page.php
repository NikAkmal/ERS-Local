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

$user_catergory = $_SESSION['user_catergory'];
// $user_catergory = "participant";

if($user_catergory=="participant"){
  $viewAllParticipant =  new accountController();
  $data = $viewAllParticipant->viewAllParticipant();
}
else{
  $viewAllOrganizer =  new accountController();
  $data = $viewAllOrganizer->viewAllOrganizer();
}

if(isset($_POST['Search'])){
	$user_catergory = $_POST['user_catergory'];
  $_SESSION['user_catergory'] = $user_catergory;
  header("Location:../../ApplicationLayer/Manage Account View/User Page.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <?php include '../../includes/AdminTopNaviBar.php';?>
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
<form method="POST" action="" style="text-align: center;">
<div class="form-row">
    <div class="col">
      <label>USER LIST:</label>
    </div>
    <div class="col" >
    <label for="user_catergory" >User Category: </label>
      <select name="user_catergory" id="user_catergory">
        <option value="participant">...</option>
        <option value="participant">Participant</option>
        <option value="organizer">Event Organizer</option>
      </select>
      <input type="submit" id="btn" name="Search" value="Search" />
    </div>
  </div>
</form>	

<form method= "post" action="../../ApplicationLayer/Manage Account View/Account Information Page.php">                  
  <div>
  <table id="table" class="center">
  <tr>
  <th style="text-align: center;"><label>USER NAME</label></th>
  <th style="text-align: center;"><label>ACCOUNT STATUS</label></th>
  <th><label></label></th>
  </tr>									
  <?php
  foreach ($data as $row) {
    //Participant Data
    if($user_catergory=="participant"){
  ?>
     <tr>
    <td><label><?=$row['participant_name']?></label></td>
    <td style="text-align: center;"><label><?=$row['participant_account_status']?></label></td>
    <td style="text-align: center;">
    <input id="btn" type="button" class="primary" onclick="location.href='../../ApplicationLayer/Manage Account View/Account Information Page.php?participant_id=<?=$row['participant_id']?>'"  value="VIEW PROFILE">&nbsp</li>
    </td>
    </tr>
  <?php
  } 
  // Event Organizer Data
  else {
  ?>
    <tr>
    <td><label><?=$row['event_organizer_name']?></label></td>
    <td style="text-align: center;"><label><?=$row['event_organizer_account_status']?></label></td>
    <td style="text-align: center;">
    <input id="btn" type="button" class="primary" onclick="location.href='../../ApplicationLayer/Manage Account View/Account Information Page.php?event_organizer_id=<?=$row['event_organizer_id']?>'"  value="VIEW PROFILE">&nbsp</li>
    </td>
    </tr>
  <?php
  }}
  ?>
</td>									
</table>
</div>
</form>

</section>
</body>
    
</html>
