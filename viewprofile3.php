<?php
		session_start();
		include "sqliconnect.php";
		$baptismname= $_SESSION['baptismname'];
		$baptismnumber= $_SESSION['baptismnumber'];
		
		$query= "SELECT DISTINCT * FROM `baptism_table` WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
		$query_run= mysqli_query($connect,$query);
		$row= mysqli_fetch_array($query_run,MYSQLI_ASSOC);	
?>

<!Doctype html>
<html>
<head>
	<title>View Parishioner Baptism Profile</title>
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
			<p><u>Parishioner Baptism, Fhc, Confirmation profile</u></p>
			<?php /*name of the parishioner selected from the DB*/ echo $row['Fullname'];?>
		</div><br>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2" >
				BAPTISM NUMBER:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Baptismnumber'];?>   
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				BAPTISM DATE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['Baptismdate'];?> 
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				BAPTISM NAME:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['Baptismname'];?>  
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				OTHER NAMES:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['Othernames'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				SURNAME:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Surname'];?> 
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				DATE OF BIRTH:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Birthdate'];?> 
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				PERMANENT ADDRESS:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Permaddress'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				FATHER'S NAME:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Fathername'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				FATHER'S RELIGION:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Fatherreligion'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				MOTHER'S NAME:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Mothername'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				MOTHER'S RELIGION:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Motherreligion'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				SOLEMN/PRIVATE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Solemn'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				GODFATHER:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Godfather'];?>  
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				GODMOTHER:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Godmother'];?>  
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				MINISTER:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Baptismminister'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				FHC DATE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Fhcdate'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				FHC PLACE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Placeoffhc'];?> 
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				FHC MINISTER:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Fhcminister'];?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				CONFIRMATION DATE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Confirmationdate'];?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				CONFIRMATION NAME:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Confirmationname'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				CONFIRMATION PLACE:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Placeofconfirmation'];?>
			</div>
		</div>
		
				<div class="row">
			<div class="col-md-6 col-md-offset-2">
				CONFIRMATION MINISTER:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['Confirmationminister'];?>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.11.2.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>