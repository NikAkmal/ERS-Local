<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <div>
      <div id="navbar" class="topnav">
        <a href="../../ApplicationLayer/Manage Event View/Event Organizer Homepage.php">ERS</a>
        <a href="../../ApplicationLayer/Manage Event View/Event Organizer Homepage.php">HOMEPAGE</a>
        <a href="../../ApplicationLayer/Manage Event View/Create Event.php">CREATE EVENT</a>
        <a href="../../ApplicationLayer/Manage Event View/Report Page.php">REPORT</a>
        <a href="../../ApplicationLayer/Manage Account View/Account Information Page.php">ACCOUNT INFORMATION</a>
        <a <input type="button" id="btn" name="LOGOUT" value="LOGOUT" 
        onclick="location.href='../../ApplicationLayer/Manage Login and Registration View/Login.php'">LOGOUT</a>
      </div>
   </div>

</head>
<style>
  /* Nav bar */
  .header {
    background-color: #white;
    padding: 30px;
    text-align: center;
  }

  #navbar {
    overflow: hidden;
    background-color: #337ab7;
  }

  #navbar a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    width: 16%;
  }

  #navbar a:hover {
    background-color: #B4CFEC;
    color: black;
  }

  #navbar a.active {
    background-color: #B4CFEC;
    color: black;
  }

  .content {
    padding: 16px;
  }

  .sticky {
    position: fixed;
    top: 0;
    width: 100%;
  }

  .sticky + .content {
    padding-top: 60px;
  }

  .topnav .search-container button {
    float: right;
    padding: 6px 10px;
    margin-top: 8px;
    margin-right: 16px;
    background: #ddd;
    font-size: 17px;
    border: none;
    cursor: pointer;
  }

  .topnav input[type=text] {
    padding: 6px;
    margin-top: 8px;
    font-size: 17px;
    border: none;
  }

  .topnav .search-container {
    float: left;
  }

  .topnav .search-container button:hover {
    background: #ccc;
  }

  @media screen and (max-width: 600px) {
    .topnav .search-container {
      float: none;
  }

  .topnav a, .topnav input[type=text], .topnav .search-container button {
      float: none;
      display: block;
      text-align: left;
      width: 100%;
      margin: 0;
      padding: 14px;
  }

</style>
</html>
