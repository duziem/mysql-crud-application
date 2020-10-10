<?php
ob_start();
	session_start();
	/*
	if(isset($_POST['fullnameandregno_submit'])){
	
			if(isset($_POST['fullname']) && isset($_POST['regno']) && !empty($_POST['fullname']) && !empty($_POST['regno'])){

				if(preg_match('/^[a-zA-Z ]+$/',$_POST['fullname']) && preg_match('/^[0-9]+$/',$_POST['regno'])){
						$fullname= strtoupper($_POST['fullname']);
						$regno= $_POST['regno'];
					
					include "sqliconnect.php";
					$query1= "SELECT DISTINCT `Fullname`,`Regno` FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					$query_run1= mysqli_query($connect,$query1);
					
					if(mysqli_num_rows($query_run1) > 0){
						//create a session that indicates that the top fields have been validated(DB contains the fullname and regno values entered)
						//$_SESSION['num_rows']= true;
						$_SESSION['fullname']= $fullname;
						$_SESSION['regno']= $regno;
						$fullname= $_SESSION['fullname'];
						$regno= $_SESSION['regno'];
						$num_rows= true;
						
							$query2= "SELECT DISTINCT * FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
							$query_run2= mysqli_query($connect,$query2);
							$row= mysqli_fetch_array($query_run2,MYSQLI_ASSOC);
							$_SESSION['Surname']= $row['Surname'];
							$_SESSION['Othernames']= $row['Othernames'];
					}
				}
			}
		}
		*/
	if(isset($_POST['fullnameandregno_submit'])){
	
			if(isset($_POST['fullname']) && isset($_POST['regno']) && !empty($_POST['fullname']) && !empty($_POST['regno'])){

				if(preg_match('/^[a-zA-Z ]+$/',$_POST['fullname']) && preg_match('/^[0-9]+$/',$_POST['regno'])){
						$fullname= strtoupper($_POST['fullname']);
						$regno= $_POST['regno'];
					
					include "sqliconnect.php";
					$query1= "SELECT DISTINCT `Fullname`,`Regno` FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					$query_run1= mysqli_query($connect,$query1);
					
					if(mysqli_num_rows($query_run1) > 0){
						//create a session that indicates that the top fields have been validated(DB contains the fullname and regno values entered)
						//$_SESSION['num_rows']= true;
						$_SESSION['fullname']= $fullname;
						$_SESSION['regno']= $regno;
						$fullname= $_SESSION['fullname'];
						$regno= $_SESSION['regno'];
						$num_rows= true;
						
							$query2= "SELECT DISTINCT * FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
							$query_run2= mysqli_query($connect,$query2);
							$row= mysqli_fetch_array($query_run2,MYSQLI_ASSOC);
							$_SESSION['Surname']= $row['Surname'];
							$_SESSION['Othernames']= $row['Othernames'];
					}
				}
			}
		}

	
	if(isset($_POST['home'])){
		session_destroy();
		header("location:parishioners_homepage.html");
	}
	if(isset($_POST['update'])){
		include "sqliconnect.php";
		$fullname= $_SESSION['fullname'];
		$regno= $_SESSION['regno'];
		$num_rows= true;

		/*		
			$requiredfields=array("surname","othernames","currentaddress","gsmnumber","officetelephone","hometelephone","email","primaryoccupation","maritalstatus","spousebaptismname","spouseothernames","placeofmarriage","nameofchildren","nameofsocieties","comments");//put all the required input fields into an array
			$requiredfieldscaps=array("Surname","Othernames","Currentaddress","Gsmnumber","Officetelephone","Hometelephone","Email","Primaryoccupation","Maritalstatus","Spousebaptismname","Spouseothernames","Placeofmarriage","Nameofchildren","Nameofsocieties","Comments");
		foreach($requiredfieldscaps as $requiredcaps){
			
			foreach($requiredfields as $required){
				if(isset($_POST[$required]) && !empty($_POST[$required])){
					echo "siiii";
					echo $requiredcaps;
					if(preg_match('/^[a-zA-Z ]+$/',$_POST[$required])){
						$updatequery_one= "UPDATE `parishioner_profile` SET `$requiredcaps`='{$_POST[$required]}' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatequery_one);
					}
				}
			}
		}	*/
				
			
				
				if(isset($_POST['surname'])&&!empty($_POST['surname'])){
					$surname= strtoupper($_POST['surname']);
					//echo 'frank';
					if(preg_match('/^[a-zA-Z ]+$/',$surname)){
						$updatesurname= "UPDATE `parishioner_profile` SET `Surname`='$surname' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatesurname);
					}
				}
				if(isset($_POST['othernames'])&&!empty($_POST['othernames'])){
					//echo 'frank';
					$othernames= strtoupper($_POST['othernames']);
					if(preg_match('/^[a-zA-Z ]+$/',$othernames)){
						$updateothernames= "UPDATE `parishioner_profile` SET `Othernames`='$othernames' WHERE `Fullname`='$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updateothernames);
					}
				}
				if((isset($_POST['surname'])&&!empty($_POST['surname']))&& empty($_POST['othernames'])){
					$surname= $_POST['surname'];
					$Othernames= $_SESSION['Othernames'];
					$Fullname= strtoupper($surname.' '.$Othernames);
					
					//echo 'success';echo $surname.'<br>';
					if(preg_match('/^[a-zA-Z ]+$/',$surname)){
						$updatefullnameone= "UPDATE `parishioner_profile` SET `Fullname`='$Fullname' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatefullnameone);
						$fullname= strtoupper($surname.' '.$Othernames);
					}
				}
				
				if(empty($_POST['surname'])&&(isset($_POST['othernames'])&&!empty($_POST['othernames']))){
					$othernames= $_POST['othernames'];
					$Surname= $_SESSION['Surname'];
					$Fullname= strtoupper($Surname.' '.$othernames);
					
					//echo 'success';echo $othernames.'<br>';
					if(preg_match('/^[a-zA-Z ]+$/',$othernames)){
						$updatefullnametwo= "UPDATE `parishioner_profile` SET `Fullname`='$Fullname' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatefullnametwo);
						$fullname= strtoupper($Surname.' '.$othernames);
					}
				}
				if((isset($_POST['othernames'])&&!empty($_POST['surname']))&&(isset($_POST['othernames'])&&!empty($_POST['othernames']))){
					$othernames= $_POST['othernames'];
					$surname= $_POST['surname'];
					$Fullname= strtoupper($surname.' '.$othernames);
					
					//echo 'success';echo $fullname;
					if(preg_match('/^[a-zA-Z ]+$/',$surname) && preg_match('/^[a-zA-Z ]+$/',$othernames)){
						$updatefullnamethree= "UPDATE `parishioner_profile` SET `Fullname`='$Fullname' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatefullnamethree);
						$fullname= strtoupper($surname.' '.$othernames);
					}
				}
				if(isset($_POST['currentaddress'])&&!empty($_POST['currentaddress'])){
					$currentaddress= strtoupper($_POST['currentaddress']);
					if(preg_match('/^[a-zA-Z, ]+$/',$currentaddress)){
						$updatecurrentaddress= "UPDATE `parishioner_profile` SET `Currentaddress`='$currentaddress' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatecurrentaddress);
					}
				}
				
				if(isset($_POST['gsmnumber'])&&!empty($_POST['gsmnumber'])){
					$gsmnumber= $_POST['gsmnumber'];
					if(preg_match('/^[0-9+]+$/',$gsmnumber)){
						$updategsmnumber= "UPDATE `parishioner_profile` SET `Gsmnumber`='$gsmnumber' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updategsmnumber);
					}
				}
				/*
				if(isset($_POST['officetelephone'])&&!empty($_POST['officetelephone'])){
					$officetelephone= $_POST['officetelephone'];
					if(preg_match('/^[0-9+]+$/',$officetelephone)){
						$updateofficetelephone= "UPDATE `parishioner_profile` SET `Officetelephone`='$officetelephone' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updateofficetelephone);
					}
				}
				if(isset($_POST['hometelephone'])&&!empty($_POST['hometelephone'])){
					$hometelephone= $_POST['hometelephone'];
					if(preg_match('/^[0-9+]+$/',$hometelephone)){
						$updatehometelephone= "UPDATE `parishioner_profile` SET `Hometelephone`='$hometelephone' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatehometelephone);
					}
				}*/
				if(isset($_POST['email'])&&!empty($_POST['email'])){
					$email= $_POST['email'];
					if(filter_var($email,FILTER_VALIDATE_EMAIL)){
						$updateemail= "UPDATE `parishioner_profile` SET `Email`='$email' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updateemail);
					}
				}
				if(isset($_POST['primaryoccupation'])&&!empty($_POST['primaryoccupation'])){
					$primaryoccupation= strtoupper($_POST['primaryoccupation']);
					if(preg_match('/^[a-zA-Z ]+$/',$primaryoccupation)){
						$updateprimaryoccupation= "UPDATE `parishioner_profile` SET `Primaryoccupation`='$primaryoccupation' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updateprimaryoccupation);
					}
				}
				if(isset($_POST['maritalstatus'])&&!empty($_POST['maritalstatus'])){
					$maritalstatus= strtoupper($_POST['maritalstatus']);
					if(preg_match('/^[a-zA-Z ]+$/',$maritalstatus)){
						$updatemaritalstatus= "UPDATE `parishioner_profile` SET `Maritalstatus`='$maritalstatus' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatemaritalstatus);
					}
				}
				if(isset($_POST['spousebaptismname'])&&!empty($_POST['spousebaptismname'])){
					$spousebaptismname= strtoupper($_POST['spousebaptismname']);
					if(preg_match('/^[a-zA-Z ]+$/',$spousebaptismname)){
						$updatespousebaptismname= "UPDATE `parishioner_profile` SET `Spousebaptismname`='$spousebaptismname' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatespousebaptismname);
					}
				}
				if(isset($_POST['spouseothernames'])&&!empty($_POST['spouseothernames'])){
					$spouseothernames= strtoupper($_POST['spouseothernames']);
					if(preg_match('/^[a-zA-Z ]+$/',$spouseothernames)){
						$updatespouseothernames= "UPDATE `parishioner_profile` SET `Spouseothernames`='$spouseothernames' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatespouseothernames);
					}
				}
				if(isset($_POST['placeofmarriage'])&&!empty($_POST['placeofmarriage'])){
					$placeofmarriage= strtoupper($_POST['placeofmarriage']);
					if(preg_match('/^[a-zA-Z ]+$/',$placeofmarriage)){
						$updateplaceofmarriage= "UPDATE `parishioner_profile` SET `Placeofmarriage`='$placeofmarriage' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updateplaceofmarriage);
					}
				}
				if(isset($_POST['numberofchildren'])&&!empty($_POST['numberofchildren'])){
					$numberofchildren= $_POST['numberofchildren'];
					if(preg_match('/^[0-6]+$/',$numberofchildren)){
						$updatenumberofchildren= "UPDATE `parishioner_profile` SET `Numberofchildren`='$numberofchildren' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatenumberofchildren);
					}
				}
				/*
				if(isset($_POST['nameofchildren1'])&&isset($_POST['nameofchildren2'])&&isset($_POST['nameofchildren3'])&&isset($_POST['nameofchildren4'])&&isset($_POST['nameofchildren5'])){
					@$nameofchildren= htmlentities(strtoupper($_POST['nameofchildren1'].' '.$_POST['nameofchildren2'].' '.$_POST['nameofchildren3'].' '.$_POST['nameofchildren4'].' '.$_POST['nameofchildren5']));
					$updatenameofchildren= "UPDATE `parishioner_profile` SET `Nameofchildren`='$nameofchildren' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updatenameofchildren);
				}*/
				
				if(isset($_POST['nameofchildren'])&&!empty($_POST['nameofchildren'])){
					$nameofchildren= strtoupper($_POST['nameofchildren']);
					if(preg_match('/^[a-zA-Z ]+$/',$nameofchildren)){
						$updatenameofchildren= "UPDATE `parishioner_profile` SET `Nameofchildren`='$nameofchildren' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatenameofchildren);
					}
				}
				if(isset($_POST['numberofsocieties'])&&!empty($_POST['numberofsocieties'])){
					$numberofsocieties= $_POST['numberofsocieties'];
					if(preg_match('/^[0-6]+$/',$numberofsocieties)){
						$updatenumberofsocieties= "UPDATE `parishioner_profile` SET `Activesocieties`='$numberofsocieties' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatenumberofsocieties);
					}
				}
				/*
				if(isset($_POST['nameofsocieties1'])&&isset($_POST['nameofsocieties2'])&&isset($_POST['nameofsocieties3'])&&isset($_POST['nameofsocieties4'])&&isset($_POST['nameofsocieties5'])&&isset($_POST['nameofsocieties6'])){
					@$nameofsocieties= htmlentities(strtoupper($_POST['nameofsocieties1'].' '.$_POST['nameofsocieties2'].' '.$_POST['nameofsocieties3'].' '.$_POST['nameofsocieties4'].' '.$_POST['nameofsocieties5'].' '.$_POST['nameofsocieties6']));
					$updatenameofsocieties= "UPDATE `parishioner_profile` SET `Nameofsocieties`='$nameofsocieties' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updatenameofsocieties);
				}*/
				
				if(isset($_POST['nameofsocieties'])&&!empty($_POST['nameofsocieties'])){
					$nameofsocieties= strtoupper($_POST['nameofsocieties']);
					if(preg_match('/^[a-zA-Z ]+$/',$nameofsocieties)){
						$updatenameofsocieties= "UPDATE `parishioner_profile` SET `Nameofsocieties`='$nameofsocieties' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatenameofsocieties);
					}
				}
				if(isset($_POST['comments'])&&!empty($_POST['comments'])){
					$comments= strtoupper($_POST['comments']);
					if(preg_match('/^[a-zA-Z ]+$/',$comments)){
						$updatecomments= "UPDATE `parishioner_profile` SET `Comments`='$comments' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatecomments);
					}
				}
				
				if(isset($_POST['lifestatus'])&&!empty($_POST['lifestatus'])){
					$lifestatus= strtoupper($_POST['lifestatus']);
					$updatelifestatus= "UPDATE `parishioner_profile` SET `Lifestatus`='$lifestatus' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updatelifestatus);
				}
				
				if((isset($_POST['yearofentry'])&&!empty($_POST['yearofentry'])) && (isset($_POST['monthofentry'])&&!empty($_POST['monthofentry'])) && (isset($_POST['dayofentry'])&&!empty($_POST['dayofentry']))){
					$yearofentry= $_POST['yearofentry'];
					$monthofentry= $_POST['monthofentry'];
					$dayofentry= $_POST['dayofentry'];
					$entrydate= $yearofentry.'-'.$monthofentry.'-'.$dayofentry;
					$updateentrydate= "UPDATE `parishioner_profile` SET `Entrydate`='$entrydate' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updateentrydate);
				}
				
				if((isset($_POST['yearofdeparture'])&&!empty($_POST['yearofdeparture'])) && (isset($_POST['monthofdeparture'])&&!empty($_POST['monthofdeparture'])) && (isset($_POST['dayofdeparture'])&&!empty($_POST['dayofdeparture']))){
					$yearofdeparture= $_POST['yearofdeparture'];
					$monthofdeparture= $_POST['monthofdeparture'];
					$dayofdeparture= $_POST['dayofdeparture'];
					$departuredate= $yearofdeparture.'-'.$monthofdeparture.'-'.$dayofdeparture;
					$updatedeparturedate= "UPDATE `parishioner_profile` SET `Departuredate`='$departuredate' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updatedeparturedate);
				}
				
				if((isset($_POST['yearofmarriage'])&&!empty($_POST['yearofmarriage'])) && (isset($_POST['monthofmarriage'])&&!empty($_POST['monthofmarriage'])) && (isset($_POST['dayofmarriage'])&&!empty($_POST['dayofmarriage']))){
					$yearofmarriage= $_POST['yearofmarriage'];
					$monthofmarriage= $_POST['monthofmarriage'];
					$dayofmarriage= $_POST['dayofmarriage'];
					$marriagedate= $yearofmarriage.'-'.$monthofmarriage.'-'.$dayofmarriage;
					$updatemarriagedate= "UPDATE `parishioner_profile` SET `Dateofmarriage`='$marriagedate' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updatemarriagedate);
				}
				
				if(isset($_POST['permaddress'])&&!empty($_POST['permaddress'])){
					$permaddress= strtoupper($_POST['permaddress']);
					$updatepermaddress= "UPDATE `parishioner_profile` SET `Permaddress`='$permaddress' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updatepermaddress);
				}
				
				if(isset($_POST['stateoforigin'])&&!empty($_POST['stateoforigin'])){
					$stateoforigin= strtoupper($_POST['stateoforigin']);
					$updatestateoforigin= "UPDATE `parishioner_profile` SET `Stateoforigin`='$stateoforigin' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updatestateoforigin);
				}
				
				if(isset($_POST['placeofbirth'])&&!empty($_POST['placeofbirth'])){
					$placeofbirth= strtoupper($_POST['placeofbirth']);
					$updateplaceofbirth= "UPDATE `parishioner_profile` SET `Placeofbirth`='$placeofbirth' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					mysqli_query($connect,$updateplaceofbirth);
				}
				
				/*if the update button is clicked execute a query that obtains the values from table parishioner_profile 
				so it can be used in the i/p fields as a placeholder */
					$query2= "SELECT DISTINCT * FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					$query_run2= mysqli_query($connect,$query2);
					$row= mysqli_fetch_array($query_run2,MYSQLI_ASSOC);
					
					unset($_SESSION['fullname']);
					unset($_SESSION['Surname']);
					unset($_SESSION['Othernames']);
					$_SESSION['fullname']= $row['Fullname'];
					$_SESSION['Surname']= $row['Surname'];
					$_SESSION['Othernames']= $row['Othernames'];
					//$fullname= $_SESSION['fullname'];
	}




?>

<!Doctype html>
<html>
<head>
	<title>Update Parishioner Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		*{
			margin:0;
			padding:0;
		}
		#container{
			width:100%;
		}
		input{
			font-size: 1.2em;
			/*height:22px;*/
		}
		select{
			font-size: 1.2em;
		}
		textarea{
			font-size: 1.2em;
		}
	</style>
</head>
<body>
	<div id="container">
			<h1 style="width:100%;color:ghostwhite;background:linear-gradient(to right,#13547a 50%,#80d0c7 100%);font-family:helvetica;min-height:80px;min-width:300px;padding:10px 0 10px 20px;text-transform:uppercase">update/view personal record interface</h1><br><br>

				<form id="form1" style="display:flex;padding-left:20px" action="updateform1.php" method="POST">
					<input placeholder="<?php if(@$row){echo $row['Fullname'];}else{echo "Type the name of the parishioner starting with the surname...";}//if(@$num_rows){echo $_POST['fullname'];}else{echo "Type the name of the parishioner starting with the surname...";}?>" style="height:22px;background:lightblue;text-transform:uppercase" type="text" name="fullname" size="80" autofocus />
					<input placeholder="<?php if(@$row){echo $row['Regno'];}else{echo "regno..";}//if(@$num_rows){echo $_POST['regno'];}else{echo "regno..";}?>" type="text" size="8" name="regno" style="height:22px;margin-left:20px;background:lightblue;text-transform:uppercase" />
					<input name="fullnameandregno_submit" type="submit" value="&#10095;" style="min-height:16px;min-width:30px;border-radius:20%;">
				</form><br>
				
				<div style="width:100%;height:1px;background:black;margin-left:20px"></div><br>
				<a href="view_profile.php" target="_blank" style="padding-left:20px;text-decoration:none"><input type="button" value="View Individual Profile" style="min-height:30px;min-width:30px;cursor:pointer;"></a><br><br>
				
				
				<div style="display:flex;padding-left:20px">
					LIFE STATUS:&nbsp;
					<select name="lifestatus" form="form2">
						<option >...</option>
						<option value="Active">ACTIVE</option>
						<option value="Deceased">DECEASED</option>
					</select>&nbsp;&nbsp;
				</div><br>
				
				<div style="width:100%;height:1px;background:black;margin-left:20px"></div><br>
				<div style="width:100%;height:1px;background:black;margin-left:20px"></div><br><br>
				
				
				<div style="display:flex;padding-left:20px">
					<div>
					NEW ENTRY DATE:
					<input form="form2" name="yearofentry" size="4" class="user_input" type="text" placeholder="Year" style="height:22px;margin-left:10px;text-transform:uppercase">
					<select name="monthofentry" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
					</select>
					<select name="dayofentry" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
					</select>
					</div><br><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div>ENTRY DATE AS ENTERED IN THE DATABASE:&nbsp;<input style="height:22px;" type="text" readonly size="12" value="<?php if(@$row){echo $row['Entrydate'];}?>" ></div>
				</div>
				
				<div style="padding-left:20px" id="departuredate_div">
					DATE OF DEPARTURE:
					<input form="form2" name="yearofdeparture" size="4" class="user_input" type="text" placeholder="Year" style="height:22px;margin-left:10px;text-transform:uppercase">
				<select name="monthofdeparture" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
				</select>
				<select name="dayofdeparture" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
				</select>
				</div><br><br>
				
				
			<div style="padding-left:30px;">
				<br><div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">PERSONAL INFORMATION >>></p>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				TITLE:<input name="title" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Title'];}?>" class="user_input" list="title" size="6" style="height:22px;margin-left:10px;text-transform:uppercase" />
				&nbsp;&nbsp;&nbsp;
				SEX:<input name="sex" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Sex'];}?>" class="user_input" list="sex" size="6" style="height:22px;margin-left:10px;text-transform:uppercase">
				<datalist id="title">
					<option value="Mr">
					<option value="Mrs">
					<option value="Sir">
					<option value="Lady">
					<option value="Chief">
					<option value="Lolo">
					<option value="Pro.">
					<option value="Dr">
					<option value="Engr">
					<option value="Barr">
					<option value="Comrade">
					<option value="Madam">
					<option value="PA">
				</datalist>
				<datalist id="sex">
					<option value="M">
					<option value="F">
				</datalist>
				<br><br>
				<form id="form2" style="display:flex" action="updateform1.php" method="POST">
					SURNAME:<input <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Surname'];}?>" size="70" name="surname" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</form><br>
				
					BAPTISM NAME:<input size="70" name="baptismname" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Baptismname'];}?>" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				
				<div style="display:flex">
					OTHER NAMES:<input form="form2" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Othernames'];}?>" size="70" name="othernames" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</div><br>
				
				
				DATE OF BIRTH:
				<input size="20" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Dateofbirth'];}?>" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				
				PLACE OF BIRTH:<input form="form2" size="50" name="placeofbirth" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Placeofbirth'];}?>" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"/><br><br>
				
				<div style="display:flex">
					CURRENT ADDRESS:<input size="50" form="form2" name="currentaddress" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Currentaddress'];}?>" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</div><br>
				PERM ADDRESS:<input form="form2" size="70" name="permaddress" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Permaddress'];}?>" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				STATE OF ORIGIN:<input form="form2" size="30" name="stateoforigin" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Stateoforigin'];}?>" class="user_input" list="state" style="height:22px;text-transform:uppercase"><br><br>
				<datalist id="state">
					<option value="Abia"><option value="Adamawa"><option value="Anambra"><option value="Bauchi"><option value="Bayelsa"><option value="Benue"><option value="Borno"><option value="Crossriver"><option value="Delta"><option value="Ebonyi"><option value="Edo"><option value="Ekiti"><option value="Enugu"><option value="FCt(Abuja)"><option value="Gombe"><option value="Imo"><option value="Jigawa"><option value="Kaduna"><option value="Kano"><option value="Katsina"><option value="Kebbi"><option value="Kogi"><option value="Kwara"><option value="Lagos"><option value="Nassarawa"><option value="Niger"><option value="Ogun"><option value="Ondo"><option value="Osun"><option value="Oyo"><option value="Plateau"><option value="Rivers"><option value="Sokoto"><option value="Taraba"><option value="Yobe"><option value="Zamfara">
				</datalist>
				
				<div style="display:flex">
					GSM NUMBER:&nbsp;<input form="form2" name="gsmnumber" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Gsmnumber'];}?>" class="user_input" type="tel" style="height:22px;text-transform:uppercase">
					
				</div><br>
				<!--
				<div style="display:flex">
					Office Telephone:&nbsp;<input form="form2" name="officetelephone" <?php// if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php //if(@$row){echo $row['Officetelephone'];}?>" class="user_input" type="tel" style="text-transform:uppercase">
					
				</div><br>
				
				<div style="display:flex">
					Home Telephone:&nbsp;<input form="form2" name="hometelephone" <?php //if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php //if(@$row){echo $row['Hometelephone'];}?>" class="user_input" type="tel" style="text-transform:uppercase">
					
				</div><br>-->
				
				<div style="display:flex">
					EMAIL:<input name="email" form="form2" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Email'];}?>" class="user_input" type="email" size="70" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</div><br/>
				
				<div style="display:flex">
					PRIMARY OCCUPATION:&nbsp;<input form="form2" size="70" name="primaryoccupation" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Primaryoccupation'];}?>" class="user_input" list="primaryoccupation" style="height:22px;text-transform:uppercase">
						<datalist id="primaryoccupation">
							<option value="ADMINISTRATOR"><option value="ACCOUNTANT"><option value="AGRICULTURIST"><option value="AIRLINE OFFICIAL"><option value="ARCHITECT"><option value="BANKER"><option value="BEAUTY/COSMETOLOGIST"><option value="BUSINESS PERSON"><option value="CATERER"><option value="CHURCH WORKER"><option value="CIVIL SERVANT"><option value="CONSULTANT"><option value="DOCTOR"><option value="DRIVER"><option value="ECONOMIST"><option value="ENGINEER"><option value="ENTREPRENEUR"><option value="ENVIROMENTALIST"><option value="ESTATE MANAGEMENT"><option value="EVENTS PLANNER"><option value="FASHION DESIGNER"><option value="GEOLOGIST">
						</datalist>
					
				</div><br/>
				
				<div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">MARITAL STATUS</p>
				<div style="width:100%;height:1px;background:black"></div><br/>
				
				<div style="display:flex">
					MARITAL STATUS:&nbsp;<input form="form2" list="maritalid" name="maritalstatus" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Maritalstatus'];}?>" style="height:22px;text-transform:uppercase;">
					<datalist id="maritalid">
						<option value="single">
						<option value="married">
					</datalist>
					
				</div><br>
				
				<div style="display:flex">
					SPOUSE'S BAPTISM NAME: <input form="form2" size="70" name="spousebaptismname" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Spousebaptismname'];}?>" class="spouseuser_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</div><br>
					
				<div style="display:flex">	
					SPOUSE'S OTHER NAMES: <input form="form2" size="70" name="spouseothernames" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Spouseothernames'];}?>" class="spouseuser_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</div><br>
				
				<div style="display:flex">				
					DATE OF MARRIAGE:
					<input form="form2" name="yearofmarriage"  size="4"  <?php if(@$num_rows){echo "";}else{echo "disabled";}?> class="spouseuser_input" type="text" placeholder="Year" style="height:22px;margin-left:10px;text-transform:uppercase">

					<input list="monthofmarriage" placeholder="Mon" size="4" form="form2" name="monthofmarriage" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> class="spouseuser_input" style="height:22px;text-transform:uppercase">
					<datalist id="monthofmarriage">
						<option value="Jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="July"><option value="Aug"><option value="Sept"><option value="Oct"><option value="Nov"><option value="Dec">
					</datalist>

					<input list="dayofmarriage" placeholder="Day" size="4" form="form2" name="dayofmarriage" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> class="spouseuser_input" style="height:22px;text-transform:uppercase"><br>
					<datalist id="dayofmarriage">
						<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
					</datalist>
				</div><br>

				
				<div style="display:flex">
					PLACE OF MARRIAGE:<input form="form2" size="70" name="placeofmarriage" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Placeofmarriage'];}?>"class="spouseuser_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</div><br>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				<div style="display:flex">
					NUMBER OF CHILDREN (UNDER 21):<input form="form2" id="childrennumberinput" name="numberofchildren" size="3" list="numberofchildren" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Numberofchildren'];}?>" style="height:22px;margin-left:10px">
					<datalist id="numberofchildren">
						<option value="1"><option value="2"><option value="3"><option value="4"><option value="5">
					</datalist>
						
				</div><br>
				
				<div style="display:flex">
					NAME OF CHILDREN:<br>(separate each name with a space)&nbsp;<textarea form="form2" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Nameofchildren'];}?>" class="childrenname_input" name="nameofchildren" cols="50" rows="5" style="text-transform:uppercase;"></textarea>
					
				</div><br>
				
				<!--Enter Name of Children:<br>
				<div style="display:flex;">
				<div style="display:flex;flex-direction:column;">
					<input form="form2" type="text" class="childrenname_input" size="50" name="nameofchildren1" style="text-transform:uppercase" <?php //if(@$num_rows){echo "";}else{echo "disabled";}?>><br>
					<input form="form2" type="text" class="childrenname_input"  size="50" name="nameofchildren2" style="text-transform:uppercase" <?php //if(@$num_rows){echo "";}else{echo "disabled";}?>><br>
					<input form="form2"  type="text" class="childrenname_input"  size="50" name="nameofchildren3" style="text-transform:uppercase" <?php// if(@$num_rows){echo "";}else{echo "disabled";}?>>
				</div>
				<div style="display:flex;flex-direction:column;margin-left:auto">
					<input form="form2"  type="text" class="childrenname_input" size="50" name="nameofchildren4" style="text-transform:uppercase" <?php //if(@$num_rows){echo "";}else{echo "disabled";}?>><br>
					<input form="form2"  type="text" class="childrenname_input"  size="50" name="nameofchildren5" style="text-transform:uppercase" <?php //if(@$num_rows){echo "";}else{echo "disabled";}?>>
				</div>
				</div><br>-->
				
				<div style="display:flex">
					YEAR OF CHURCH MEMBERSHIP:<input form="form2" name="yearofchurchmembership" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Yearofmembership'];}?>" size="4" type="text" style="height:22px;margin-left:10px;text-transform:uppercase">
					
				</div><br>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				<div style="display:flex">
					ACTIVE SOCIETIES:<input form="form2" id="societynumberinput" name="numberofsocieties" size="3" list="numberofsocieties" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Activesocieties'];}?>" style="height:22px;margin-left:10px;">
					<datalist id="numberofsocieties">
						<option value="1"><option value="2"><option value="3"><option value="4"><option value="5"><option value="6">
					</datalist>
					
				</div><br>
				
				<div style="display:flex">
					NAME OF SOCIETIES:<br>(separate each name with a space)&nbsp;<textarea form="form2" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Nameofsocieties'];}?>" class="societiesname_input" name="nameofsocieties" cols="50" rows="5" style="text-transform:uppercase;"></textarea>
					
				</div><br>
				
				<!--Enter Name of Societies:<br>
				<div style="display:flex;">
				<div style="display:flex;flex-direction:column;">
					<input form="form2" type="text" size="50" name="nameofsocieties1" style="text-transform:uppercase" <?//php if(@$num_rows){echo "";}else{echo "disabled";}?>><br>
					<input form="form2" type="text"  size="50" name="nameofsocieties2" style="text-transform:uppercase" <?//php if(@$num_rows){echo "";}else{echo "disabled";}?>><br>
					<input form="form2"  type="text" size="50" name="nameofsocieties3" style="text-transform:uppercase" <?//php if(@$num_rows){echo "";}else{echo "disabled";}?>>
				</div>
				<div style="display:flex;flex-direction:column;margin-left:auto">
					<input form="form2"  type="text" size="50" name="nameofsocieties4" style="text-transform:uppercase" <?php// if(@$num_rows){echo "";}else{echo "disabled";}?>><br>
					<input form="form2"  type="text"  size="50" name="nameofsocieties5" style="text-transform:uppercase" <?php// if(@$num_rows){echo "";}else{echo "disabled";}?>><br>
					<input form="form2"  type="text"  size="50" name="nameofsocieties6" style="text-transform:uppercase" <?php// if(@$num_rows){echo "";}else{echo "disabled";}?>>
				</div>
				</div><br>-->
				
				
				<div style="display:flex">
					COMMENTS:<br><textarea form="form2" name="comments" cols="60" rows="10" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Comments'];}?>" class="user_input" style="text-transform:uppercase"></textarea>
						
				</div><br><br>
				<div style="display:flex;width:100%;min-height:30px;background:teal;position:fixed;bottom:0;"><input form="form2" type="submit" value="UPDATE" name="update" style="width:86px;height:30px"><a href="stanthony_home.html" style="text-decoration:none"><input form="form2" type="submit" name="home" value="Home" style="width:60px;height:30px;cursor:pointer"></a></div>
			
			</div>								
	</div>
</html>