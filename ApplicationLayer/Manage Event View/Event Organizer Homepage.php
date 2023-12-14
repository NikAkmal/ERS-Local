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

$event_organizer_id = $_SESSION['event_organizer_id'];

$event_category = $_SESSION['event_category'];

//Account Information Reset
$_SESSION['information'] = 0;

if($event_category=="all"){
  $viewAllEventOrganizer =  new eventController();
  $data = $viewAllEventOrganizer->viewAllEventOrganizer($event_organizer_id);
}
else{
  $viewEventCategoryOrganizer =  new eventController();
  $data = $viewEventCategoryOrganizer->viewEventCategoryOrganizer($event_organizer_id, $event_category);
}

if(isset($_POST['Search'])){
	$event_category = $_POST['event_category'];
  $_SESSION['event_category'] = $event_category;
  header("Location:../../ApplicationLayer/Manage Event View/Event Organizer Homepage.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Organizer Homepage</title>
    <?php include '../../includes/EventOrganizerTopNaviBar.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
  /* Image Slide Show */
  * {box-sizing: border-box}
  body {font-family: Verdana, sans-serif; margin:0}
  .mySlides {display: none}
  img {vertical-align: middle;}

  /* Slideshow container */
  .slideshow-container {
    width: 900px;
    height: 330px;
    position: relative;
    margin: auto;

  }

  /* Next & previous buttons */
  .prev, .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -22px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
  }

  /* Position the "next button" to the right */
  .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }

  /* On hover, add a black background color with a little bit see-through */
  .prev:hover, .next:hover {
    background-color: rgba(0,0,0,0.8);
  }

  /* Caption text */
  .text {
    color: #f2f2f2;
    font-size: 15px;
    padding: 8px 12px;
    position: absolute;
    bottom: 8px;
    width: 100%;
    text-align: center;
  }

  /* Number text (1/3 etc) */
  .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
  }

  /* The dots/bullets/indicators */
  .dot {
    cursor: pointer;
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
  }

  .active, .dot:hover {
    background-color: #717171;
  }

  /* Fading animation */
  .fade {
    -webkit-animation-name: fade;
    -webkit-animation-duration: 1.5s;
    animation-name: fade;
    animation-duration: 1.5s;
  }

  @-webkit-keyframes fade {
    from {opacity: .4} 
    to {opacity: 1}
  }

  @keyframes fade {
    from {opacity: .4} 
    to {opacity: 1}
  }

  /* On smaller screens, decrease text size */
  @media only screen and (max-width: 300px) {
    .prev, .next,.text {font-size: 11px}
  }

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

<div>
  <div class="slideshow-container">

  <div class="mySlides fade" style="text-align: center;">
    <div class="numbertext">1 / 3</div>
    <img src="https://www.searchenginejournal.com/wp-content/uploads/2021/02/event-structured-data-6017c10a34361-1520x800.webp" style="width:78%">
    <div class="text">Event Registration System</div>
</div>

<div class="mySlides fade" style="text-align: center;">
    <div class="numbertext">2 / 3</div>
    <img src="https://cdn.socio.events/spai/q_glossy+w_966+to_avif+ret_img/socio.events/wp-content/uploads/2022/10/AdobeStock_503243650-2048x1184.jpeg" style="width: 71%">
    <div class="text">Event Registration System</div>
  </div>

  <div class="mySlides fade" style="text-align: center;">
    <div class="numbertext">3 / 3</div>
    <img src="https://cdn.searchenginejournal.com/wp-content/uploads/2016/04/shutterstock_217119211-760x312.jpg" style="width:100%">
    <div class="text">Event Registration System</div>
  </div>

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>

  </div>
  <br>

  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span> 
    <span class="dot" onclick="currentSlide(2)"></span> 
    <span class="dot" onclick="currentSlide(3)"></span> 
  </div>

  <script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 1500); // Change image every 1.5 seconds
}
</script>
</div>

<section>

<form method="POST" action="" style="text-align: center;">
  <div class="form-row">
    <div class="col">
      <label>EVENT CREATED:</label>
    </div>
    <div class="col">
      <label for="event_category">Filter Category:</label>
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

<form method="post" action="../../ApplicationLayer/Manage Event View/Information Page.php" id="table-container">
  <div>
    <table id="table">
      <tr>
        <th><label>EVENT NAME</label></th>
        <th><label>START DATE</label></th>
        <th><label>END DATE</label></th>
        <th><label>APPROVAL STATUS</label></th>
        <th></th>
      </tr>
      <?php foreach ($data as $row) { ?>
        <tr>
          <td><?= $row['event_name'] ?></td>
          <td><?= $row['event_start_date'] ?></td>
          <td><?= $row['event_end_date'] ?></td>
          <td><?= $row['event_request_status'] ?></td>
          <td>
            <input id="btn" type="button" class="primary" onclick="location.href='../../ApplicationLayer/Manage Event View/Information Page.php?event_id=<?= $row['event_id'] ?>'" value="INFORMATION">
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</form>

</section>

</body>
    
</html>
