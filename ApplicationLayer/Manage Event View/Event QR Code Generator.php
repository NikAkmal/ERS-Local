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
$event_id = $_SESSION['event_id'];

if(isset($_POST['save'])){
	$event_qr_code	 = $_POST['event_qr_code'];
	$updateQRCODE = new eventController();  
	$updateQRCODE->updateQRCODE($event_id, $event_qr_code);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Event QR Code Generator</title>
    <?php include '../../includes/EventOrganizerTopNaviBar.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

<style>
	.qr-code {
	max-width: 200px;
	margin: 10px;
	}

	#generate, #btn{
		font-weight: normal;
		color: #fff;
		background: #337ab7;
		padding: 5px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
	
</style>

</head>

<body>
<body>
<form method = "post">
	<h2 style="text-align: center;">EVENT QR CODE GENERATOR</h2>
	<table style="width:100%">
		<tr>
			<th><div class="container-fluid">
    		<div  style="text-align: center;">
      	<img src= "https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0"
        class="qr-code img-thumbnail img-responsive" />
   		 </div></th>
		</tr>
		<tr>
		<div class="form-horizontal">
     	<div class="form-group">
        <td style="text-align: center;"><label for="content">Code:</label>
        <div>
            <!-- Input box to enter the required data -->
			<input type="text" name="event_qr_code" size="60" maxlength="60" id="content" placeholder="Enter content" /></td>
        </div>
     	</div>
		</tr>
		<tr>
			<td style="text-align: center;">
			<div class="form-group">
        	<div>
            <!-- Button to generate QR Code for the entered data -->
          	<button type="button" class= "btn btn-default" id="generate">GENERATE</button></td>
			</tr><tr><td style="text-align: center;">
			<input type="submit" id="btn" name="save" value="SAVE TO DATABASE" />
        </div>
      </div>
    </div>
  </div></td>
		</tr>
	</table>
      
</form>
  <script src= "https://code.jquery.com/jquery-3.5.1.js"></script>
  
  <script>
	
    function htmlEncode(value) {
      return $('<div/>').text(value)
        .html();
    }
  
    $(function () {
      $('#generate').click(function () {
        let finalURL = 'https://chart.googleapis.com/chart?cht=qr&chl=' + htmlEncode($('#content').val()) + '&chs=160x160&chld=L|0'
        $('.qr-code').attr('src', finalURL);
		// document.getElementById('content').value=c;
		// document.forms[0].submit();
      });
    });
	</script>
</body>
  
</html>