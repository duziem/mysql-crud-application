<?php
		session_start();
		include "sqliconnect.php";
		$fullname= $_SESSION['fullname'];
		$regno= $_SESSION['regno'];
		
		$query= "SELECT DISTINCT * FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
		$query_run= mysqli_query($connect,$query);
		$row= mysqli_fetch_array($query_run,MYSQLI_ASSOC);
?>

<!Doctype html>
<html>
<head>
	<title>View Parishioner Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" rel="text/css" href="css/bootstrap.css">
</head>
<style>
	*,*::before,*::after{
		margin:0;
		padding:0;
		box-sizing:border-box;
	}
</style>

<body>
	<div class="container" style="font-size:1.3em">
		<div class="text-center">
			<b><p>ST ANTHONY'S CATHOLIC CHURCH GBAJA,<BR> SURULERE, LAGOS<p></b>
			<p><u>Parishioner profile</u></p>
			<?php /*name of the parishioner selected from the DB*/ echo $row['Fullname'];?>
		</div><br>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2" >
				TITLE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Title'];?>   
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				SEX: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['Sex'];?> 
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				REGNO:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['Regno'];?>  
			</div>
		</div>
		
		<!--<div class="row">
			<div class="col-md-6 col-md-offset-2">
				AGE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php//echo $row['Age'];?>
			</div>
		</div>-->
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				DATE OF BIRTH:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Dateofbirth'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				PLACE OF BIRTH:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Placeofbirth'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				CURRENT ADDRESS:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Currentaddress'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				PERMANENT ADDRESS:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Permaddress'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				STATE OF ORIGIN:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Stateoforigin'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				PHONE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Gsmnumber'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				EMAIL:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Email'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				PROFFESSION:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Primaryoccupation'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				SPOUSE FIRST NAME: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Spousebaptismname'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				SPOUSE OTHER NAMES:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Spouseothernames'];?>  
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				DATE OF MARRIAGE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Dateofmarriage'];?>  
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				PLACE OF MARRIAGE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Placeofmarriage'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				LIST OF CHILDREN UNDER 21:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Nameofchildren'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				MEMBERSHIP YEAR:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Yearofmembership'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				SOCIETIES LIST:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Nameofsocieties'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				COMMENTS:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Comments'];?>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.11.2.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>