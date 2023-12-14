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

//Report Data
$report_select = $_SESSION['report_select'];

if ($account_type == "admin"){
	$admin_id  = $_SESSION['admin_id'];
	$event_id = 0;
}
if ($account_type == "organizer"){
	$event_organizer_id  = $_SESSION['event_organizer_id'];
	$event_id  = $_SESSION['event_id'];
	//Retrieve all event list 
	$viewAllEventOrganizer =  new eventController();
	$data = $viewAllEventOrganizer->viewAllEventOrganizer($event_organizer_id);	
}

//Button
if(isset($_POST['Report'])){
	$report_select = $_POST['report_select'];
	$event_id = $_POST['event_id'];
  	$_SESSION['report_select'] = $report_select;
	$_SESSION['event_id'] = $event_id;	
  	header("Location:../../ApplicationLayer/Manage Event View/Report Page.php");
}

if(isset($_POST['INFORMATION'])){
	$_SESSION['information'] = 1;
	$participant_id = $_POST['participant_id'];	
	$_SESSION['participant_id'] = $participant_id;	
  	header("Location:../../ApplicationLayer/Manage Account View/Account Information Page.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Page</title>
    <?php 
		if($account_type== "admin"){
			include '../../includes/AdminTopNaviBar.php';
		}
		
		if($account_type== "organizer"){
			include '../../includes/EventOrganizerTopNaviBar.php';
		}
	?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>

#table{
	text-align: center;
	width:100%;
	margin-left: auto; 
  	margin-right: auto;
}

#table2{
	border: 1px solid black;
	text-align: center;
	width: 95%;
	margin-left: auto; 
  	margin-right: auto;
	background-color: #B4CFEC;
}

#line{
	border: 1px solid black;
}

/* button */

#btn{
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
	<form action="" method="POST">
		<h2 style="text-align: center;">REPORT PAGE</h2>
		
		<?php
		//Event Organizer Report
		if ($account_type == "organizer"){?>
			<table id="table">
			<tr>
				<th style="text-align: center;">
					<label for="report_select">SELECT REPORT:</label>
						<select name="report_select" id="report_select">
							<option value="empty">...</option>
							<option value="1">Participated List</option>
							<option value="2">Event List</option>
						</select>
				</th>
			</tr>
			<tr>
				<th style="text-align: center;">
					<!-- All event that the event organizer created should be display here -->
					<label for="event_id">SELECT EVENT:</label>
						<select name="event_id" id="event_id">
							<option value="empty">...</option>
							<?php
								foreach ($data as $row) {
							?>
							<option value="<?=$row['event_id']?>"><?=$row['event_name']?></option>
							<?php
							//$event_id = $row['event_id'];
							?>
							<?php
								}
							?>
						</select>
				</th>
			</tr>
		</table>

		<?php }
		//Admin Report
		if ($account_type == "admin"){
		?>
		<table id="table">
			<tr>
				<th style="text-align: center;">
					<label for="report_select">SELECT REPORT:</label>
						<select name="report_select" id="report_select">
							<option value="empty">...</option>
							<option value="3">User Statistics</option>
							<option value="4">Event Statistics</option>
						</select>
					</th>
				</tr>
		<?php }?>

		<!-- button -->
		<table id="table">
		<tr>
		<th style="text-align: center;"><input type="submit" id="btn" name="Report" value="REPORT" /></th>
		</tr>
		</table>
	</form>

	<div>
		<?php
			//Event Organizer
			//Load Participated Report 
			//Table
			if($report_select == '1'){			
				$participatedReportTitle =  new eventController();
				//Retrieve all Participant list
				$title = $participatedReportTitle->participatedReportTitle($event_id);
				$counter = '1';
				foreach ($title as $data) {
				?>
						<h2 style="text-align: center;"><?=$data['event_name']?> REPORT</h2>
				<?php 
				}?>
				
				<form action="" method="POST">
					<table id="table2" class="center">
					<tr id="line">
					<th style="text-align: center;"><label>PARTICIPANT NAME</label></th>
					<th style="text-align: center;"><label>PARTICIPANT MATRIC ID</label></th>
					<th><label></label></th></tr>									
				
				<?php
					$participatedReport =  new eventController();
					//Retrieve all Participant list
					$participated = $participatedReport->participatedReport($event_id);
					foreach ($participated as $row) {
				?>	
					<input type="hidden" name="participant_id" value="<?=$row['participant_id']?>">  
					<tr>
					<td id="line" style="text-align: left;"><label><?=$row['participant_name']?></label></td>
					<td id="line" style="text-align: center;"><label><?=$row['participant_matric_id']?></label></td>
					<td id="line" style="text-align: center;">
					<!-- <input id="btn" type="button" class="primary" onclick="location.href='../../ApplicationLayer/Manage Account View/Account Information Page.php?participant_id=<?=$row['participant_id']?>'"  value="INFORMATION">&nbsp</li> -->
					<input type="submit" id="btn" name="INFORMATION" value="INFORMATION" />
					</td></tr>
				<?php	}	?></td>									
				</table>
				</form>


		<?php	}?>
	</div>

	<?php
			//Event Organizer
			//Load Number of Participant Report 
			//Bar Chart
			if($report_select == '2'){		
			?>	
			<center><canvas id="myChart" style="width:100%;max-width:80%"></canvas></center>

			<script>
			
			var xValues = [
			<?php
				//Event Title
				$viewAllEventOrganizer =  new eventController();
				$data = $viewAllEventOrganizer->viewAllEventOrganizer($event_organizer_id);
				foreach ($data as $row) {
			?>
				"<?=$row['event_name']?>",
			<?php
				}
			?>];

			var yValues = [
			<?php
				$viewAllEventOrganizer =  new eventController();
				$data = $viewAllEventOrganizer->viewAllEventOrganizer($event_organizer_id);
				foreach ($data as $row) {
				$event_id = $row['event_id'];
				//Event Total Participant
				$totalParticipated =  new eventController();
				$total = $totalParticipated->totalParticipated($event_id);
				foreach ($total as $total) {
			?>
				"<?=$total['total_participated']?>",
			<?php
				}}
			?>,0]; 
			// 0 here is for the lowest value to be set as default so that the second lowest value will be display

			var barColors = [
			<?php
				$viewAllEventOrganizer =  new eventController();
				$data = $viewAllEventOrganizer->viewAllEventOrganizer($event_organizer_id);
				foreach ($data as $row) {
			?>
				"blue",
			<?php
				}
			?>];

			new Chart("myChart", {
			type: "bar",
			data: {
				labels: xValues,
				datasets: [{
				backgroundColor: barColors,
				data: yValues
				}]
			},
			options: {
				legend: {display: false},
				title: {
				display: true,
				text: "Number of Participant Report"
				}
			}
			});
			</script>	
	<?php	}?>

	<?php
		//Admin Report	
		if($account_type == "admin"){		
		?>

		<center><div id="piechart"></div></center>

		<script type="text/javascript">
		// Load google charts
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		
		<?php
		// Admin User Statistics
		if($report_select == "3"){
			//Admin Total
			$totalAdmin =  new eventController();
			$data = $totalAdmin->totalAdmin();
			foreach ($data as $row) {
				$total_admin = $row['total_admin'];
			}
			//Event Organizer Total
			$totalOrganizer =  new eventController();
			$data = $totalOrganizer->totalOrganizer();
			foreach ($data as $row) {
				$total_organizer = $row['total_organizer'];			
			}
			//Participant Total
			$totalParticipant =  new eventController();
			$data = $totalParticipant->totalParticipant();
			foreach ($data as $row) {
				$total_participant = $row['total_participant'];				
			}
		?>
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
			['User', 'Hours per Day'],
			['Admin', <?php echo $total_admin ?>],
			['Event Organizer', <?php echo $total_organizer ?>],
			['Participant', <?php echo $total_participant ?>],
		]);

		var options = {'title':'TOTAL AMOUNT OF USER IN ERS', 'width':750, 'height':650};
		
		<?php }

		// Admin Event Statistics
		if($report_select == "4"){	
			//Total Completed Event in the system
			$totalCompletedEvent =  new eventController();
			$data = $totalCompletedEvent->totalCompletedEvent();
			foreach ($data as $row) {
				$total_completed_event = $row['total_completed_event'];
			}
			//Total Today Event in the system
			$totalTodayEvent =  new eventController();
			$data = $totalTodayEvent->totalTodayEvent();
			foreach ($data as $row) {
				$total_today_event = $row['total_today_event'];			
			}
			//Total Upcoming Event in the system
			$totalUpcomingEvent =  new eventController();
			$data = $totalUpcomingEvent->totalUpcomingEvent();
			foreach ($data as $row) {
				$total_upcoming_event = $row['total_upcoming_event'];				
			}
		?>

		function drawChart() {
		var data = google.visualization.arrayToDataTable([
		['Event Status', 'Hours per Day'],
		['Completed Event', <?php echo $total_completed_event ?>],
		['Today Event', <?php echo $total_today_event ?>],
		['Upcoming Event', <?php echo $total_upcoming_event ?>],
		]);

		// Optional; add a title and set the width and height of the chart
		var options = {'title':'ALL EVENT STATISTICS IN ERS', 'width':750, 'height':650};
		<?php	}?>

		// Display the chart inside the <div> element with id="piechart"
		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);
		}
		</script>

	<?php	}?>
</body>
  
</html>