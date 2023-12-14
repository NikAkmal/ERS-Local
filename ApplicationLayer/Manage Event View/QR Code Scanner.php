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

$participant_id = $_SESSION['participant_id'];
$event_id  = $_SESSION['event_id'];

$event_qr_code  = $_SESSION['event_qr_code'];

//To prevent user from registering twice
$viewEventRecord =  new eventController();
$data = $viewEventRecord->viewEventRecord($event_id);
foreach ($data as $row) {
  $participant_iddb = $row['participant_id'];
  if($participant_id == $participant_iddb){ 
    echo "<script type='text/javascript'>alert('You have registered this event!');
    window.location='Participant Homepage.php';
    </script>";
  }
}



if(isset($_POST['text'])){
  $text = $_POST['text'];
  if($text == $event_qr_code){
    $registerParticipant = new eventController();  
	  $registerParticipant->registerParticipant($event_id, $participant_id);
  }
} 

?> 

<!DOCTYPE html>
<html>
  <head>
    <title>QR CODE SCANNER</title>
    <?php include '../../includes/ParticipantTopNaviBar.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src = "https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  </head>

  <style>
body {
  background-color: #white;
}

/* form */
#frm{
	text-align: center;
	border: solid grey 1px;
	width: 30%;
	border-radius: 2px;
	margin: 25px auto;
	background: #B4CFEC;
	padding: 225px;
}
  </style>
  
  <body>    
          <table style="width:100%" style="text-align: center;">
            <tr>
              <th style="text-align: center;"><h2>EVEN QR CODE SCANNER</h2></th>
            </tr>
            <tr>
              <td style="text-align: center;">
              <div class="container">
                  <video id="preview" width="30%"></video>
                </div>
                </td>
            </tr>
            <tr>
              <td style="text-align: center;">
              <form action="" method="post">
                <input type="hidden" name="text" id="text" readonny="" placeholder="">
              </form>
            </tr>
          </table>
          </td>


      <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length>0){
            scanner.start(cameras[0]);
            $('[name="options"]').on('change',function(){
                if($(this).val()==1){
                    if(cameras[0]!=""){
                        scanner.start(cameras[0]);
                    }else{
                        alert('No Front camera found!');
                    }
                }else if($(this).val()==2){
                    if(cameras[1]!=""){
                        scanner.start(cameras[1]);
                    }else{
                        alert('No Back camera found!');
                    }
                }
            });
        }else{
            console.error('No cameras found.');
            alert('No cameras found.');
        }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
               document.forms[0].submit();
           });
        </script>
        
  </body>
</html>

