<?php
ob_start();
	session_start();
	//include "sqliconnect.php";
		if(isset($_POST['baptismnameandno_submit'])){
	
			if(isset($_POST['baptismname']) && isset($_POST['baptismnumber']) && !empty($_POST['baptismname']) && !empty($_POST['baptismnumber'])){

				if(preg_match('/^[a-zA-Z ]+$/',$_POST['baptismname']) && preg_match('/^[0-9]+$/',$_POST['baptismnumber'])){
						$baptismname= strtoupper($_POST['baptismname']);
						$baptismnumber= $_POST['baptismnumber'];
					
					include "sqliconnect.php";
					$query1= "SELECT DISTINCT `Baptismname`,`Baptismnumber` FROM `baptism_table` WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
					$query_run1= mysqli_query($connect,$query1);
					
					if(mysqli_num_rows($query_run1) > 0){
						//create a session that indicates that the top fields have been validated(DB contains the fbaptismname and baptismnumber values entered)
						//$_SESSION['num_rows']= true;
						$_SESSION['baptismname']= $baptismname;
						$_SESSION['baptismnumber']= $baptismnumber;
						$baptismname= $_SESSION['baptismname'];
						$baptismnumber= $_SESSION['baptismnumber'];
						$num_rows= true;
						
							$query2= "SELECT * FROM `baptism_table` WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
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
		header("location:baptism_homepage.html");
	}
	if(isset($_POST['update'])){
		include "sqliconnect.php";
		$baptismname= $_SESSION['baptismname'];
		$baptismnumber= $_SESSION['baptismnumber'];
		$num_rows= true;

		$textfields= array("Othernames"=>"othernames","Surname"=>"surname","Permaddress"=>"permaddress","Placeofbirth"=>"placeofbirth","Fathername"=>"fathername","Fatherreligion"=>"fatherreligion","Mothername"=>"mothername","Motherreligion"=>"motherreligion","Godfather"=>"godfather","Godmother"=>"godmother","Baptismminister"=>"baptismminister","Placeoffhc"=>"placeoffhc","Fhcminister"=>"fhcminister","Confirmationname"=>"confirmationname","Placeofconfirmation"=>"placeofconfirmation","Confirmationminister"=>"confirmationminister");
		foreach($textfields as $textfieldsheader => $textfieldsvalue){
			if(isset($_POST[$textfieldsvalue]) && !empty($_POST[$textfieldsvalue])){
				if(preg_match('/^[A-Za-z ]*$/',$_POST[$textfieldsvalue])){
					$textfieldsvalue= htmlentities(strtoupper($_POST[$textfieldsvalue]));
					$updatetextfields= "UPDATE `baptism_table` SET `$textfieldsheader`='$textfieldsvalue' WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
					mysqli_query($connect,$updatetextfields);
				}
			}
		}
		
		
						if((isset($_POST['surname'])&&!empty($_POST['surname']))&& empty($_POST['othernames'])){
					$surname= $_POST['surname'];
					$Othernames= $_SESSION['Othernames'];
					$Fullname= htmlentities(strtoupper($surname.' '.$Othernames));
					
					//echo 'success';echo $surname.'<br>';
					if(preg_match('/^[a-zA-Z ]+$/',$surname)){
						$updatefullnameone= "UPDATE `baptism_table` SET `Fullname`='$Fullname' WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
						mysqli_query($connect,$updatefullnameone);
						//$fullname= strtoupper($surname.' '.$Othernames);
					}
				}
				
				if(empty($_POST['surname'])&&(isset($_POST['othernames'])&&!empty($_POST['othernames']))){
					$othernames= $_POST['othernames'];
					$Surname= $_SESSION['Surname'];
					$Fullname= htmlentities(strtoupper($Surname.' '.$othernames));
					
					//echo 'success';echo $othernames.'<br>';
					if(preg_match('/^[a-zA-Z ]+$/',$othernames)){
						$updatefullnametwo= "UPDATE `baptism_table` SET `Fullname`='$Fullname' WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
						mysqli_query($connect,$updatefullnametwo);
						//$fullname= strtoupper($Surname.' '.$othernames);
					}
				}
				if((isset($_POST['othernames'])&&!empty($_POST['surname']))&&(isset($_POST['othernames'])&&!empty($_POST['othernames']))){
					$othernames= $_POST['othernames'];
					$surname= $_POST['surname'];
					$Fullname= htmlentities(strtoupper($surname.' '.$othernames));
					
					//echo 'success';echo $fullname;
					if(preg_match('/^[a-zA-Z ]+$/',$surname) && preg_match('/^[a-zA-Z ]+$/',$othernames)){
						$updatefullnamethree= "UPDATE `baptism_table` SET `Fullname`='$Fullname' WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
						mysqli_query($connect,$updatefullnamethree);
						//$fullname= strtoupper($surname.' '.$othernames);
					}
				}
		
		
		
				if((isset($_POST['yearoffhc'])&&!empty($_POST['yearoffhc'])) && (isset($_POST['monthoffhc'])&&!empty($_POST['monthoffhc'])) && (isset($_POST['dayoffhc'])&&!empty($_POST['dayoffhc']))){
					$yearoffhc= $_POST['yearoffhc'];
					$monthoffhc= $_POST['monthoffhc'];
					$dayoffhc= $_POST['dayoffhc'];
					$fhcdate= $yearoffhc.'-'.$monthoffhc.'-'.$dayoffhc;
					$updatefhcdate= "UPDATE `baptism_table` SET `Fhcdate`='$fhcdate' WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
					mysqli_query($connect,$updatefhcdate);
				}
				
				if((isset($_POST['yearofconfirmation'])&&!empty($_POST['yearofconfirmation'])) && (isset($_POST['monthofconfirmation'])&&!empty($_POST['monthofconfirmation'])) && (isset($_POST['dayofconfirmation'])&&!empty($_POST['dayofconfirmation']))){
					$yearofconfirmation= $_POST['yearofconfirmation'];
					$monthofconfirmation= $_POST['monthofconfirmation'];
					$dayofconfirmation= $_POST['dayofconfirmation'];
					$confirmationdate= $yearofconfirmation.'-'.$monthofconfirmation.'-'.$dayofconfirmation;
					$updateconfirmationdate= "UPDATE `baptism_table` SET `Confirmationdate`='$confirmationdate' WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
					mysqli_query($connect,$updateconfirmationdate);
				}
				
					$query2= "SELECT DISTINCT * FROM `baptism_table` WHERE `Baptismname`='$baptismname' AND `Baptismnumber`='$baptismnumber'";
					$query_run2= mysqli_query($connect,$query2);
					$row= mysqli_fetch_array($query_run2,MYSQLI_ASSOC);
					
					//unset($_SESSION['fullname']);
					unset($_SESSION['Surname']);
					unset($_SESSION['Othernames']);
					//$_SESSION['fullname']= $row['Fullname'];
					$_SESSION['Surname']= $row['Surname'];
					$_SESSION['Othernames']= $row['Othernames'];
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
			height:22px;
		}
		.user_input{
			height:22px;
			font-size: 1.2em;
		}
	</style>
</head>
<body>
	<div id="container">
			<h1 style="width:100%;color:ghostwhite;background:linear-gradient(to right,#13547a 50%,#80d0c7 100%);font-family:helvetica;min-height:80px;min-width:300px;padding:10px 0 10px 20px;text-transform:uppercase">update/view parishioner baptism record interface</h1><br><br>

				<form style="display:flex;padding-left:20px" action="baptism_update.php" method="POST">
					<input placeholder="<?php if(@$row){echo $row['Baptismname'];}else{echo "Type the Baptism Name of the Parishioner...";}?>" style="background:lightblue;text-transform:uppercase;font-size: 1.2em;" type="text" name="baptismname" size="50" autofocus />
					<input placeholder="<?php if(@$row){echo $row['Baptismnumber'];}else{echo "regno..";}?>" type="text" size="8" name="baptismnumber" style="margin-left:20px;background:lightblue;text-transform:uppercase;font-size: 1.2em;" />
					<input name="baptismnameandno_submit" type="submit" value="&#10095;" style="min-height:16px;min-width:30px;border-radius:20%;">
				</form><br>
				
	<form style="padding-left:20px" action="baptism_update.php" method="POST" id="baptismform">
		BAPTISM DATE: <input size="20" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Baptismdate'];}?>" class="user_input" type="text" style="margin-left:10px;"><br><br>
		
		OTHER NAMES: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Othernames'];}?>" name="othernames" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		SURNAME: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="surname" placeholder="<?php if(@$row){echo $row['Surname'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		DATE OF BIRTH: <input size="20" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Birthdate'];}?>" class="user_input" type="text" style="margin-left:10px;"><br><br>
		
		PLACE OF BIRTH: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="placeofbirth" placeholder="<?php if(@$row){echo $row['Placeofbirth'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		PERMANENT ADDRESS: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="permaddress" placeholder="<?php if(@$row){echo $row['Permaddress'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		FATHER'S NAME: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="fathername" placeholder="<?php if(@$row){echo $row['Fathername'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		FATHER'S RELIGION: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="fatherreligion" placeholder="<?php if(@$row){echo $row['Fatherreligion'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		MOTHER'S NAME: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="mothername" placeholder="<?php if(@$row){echo $row['Mothername'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		MOTHER'S RELIGION: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="motherreligion" placeholder="<?php if(@$row){echo $row['Motherreligion'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		
		GOD FATHER: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="godfather" placeholder="<?php if(@$row){echo $row['Godfather'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		GOD MOTHER: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="godmother" placeholder="<?php if(@$row){echo $row['Godmother'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		BAPTISM MINISTER: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="baptismminister" placeholder="<?php if(@$row){echo $row['Baptismminister'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		
		<div class="fhccontainer active">
			<div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">FHC>>></p>
			<div style="width:100%;height:1px;background:black"></div><br><br>
			
		FHC DATE:  <input size="20" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="Fhcdate" readonly placeholder="<?php if(@$row){echo $row['Fhcdate'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br>
		
		ENTER NEW FHC DATE:
		<input name="yearoffhc" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
		<input name="monthoffhc" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> size="3" class="user_input" list="monthoffhc" placeholder="Mon" style="text-transform:uppercase">
			<datalist id="monthoffhc">
				<option value="Jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="July"><option value="Aug"><option value="Sept"><option value="Oct"><option value="Nov"><option value="Dec">
			</datalist>
		<input name="dayoffhc" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> size="2" class="user_input" list="dayoffhc" placeholder="Day" style="text-transform:uppercase"><br><br>
			<datalist id="dayoffhc">
				<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
			</datalist>
			
			FHC PLACE: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="placeoffhc" placeholder="<?php if(@$row){echo $row['Placeoffhc'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
			FHC MINISTER: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="fhcminister" placeholder="<?php if(@$row){echo $row['Fhcminister'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		</div>
		
		
		<div class="confirmationcontainer active">
			<div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">CONFIRMATION>>></p>
			<div style="width:100%;height:1px;background:black"></div><br><br>
		
		CONFIRMATION DATE:  <input size="20" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="Confirmationdate" readonly placeholder="<?php if(@$row){echo $row['Confirmationdate'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br>
		
		ENTER NEW CONFIRMATION DATE:
		<input name="yearofconfirmation" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
		<input name="monthofconfirmation" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> size="3" class="user_input" list="monthofconfirmation" placeholder="Mon" style="text-transform:uppercase">
			<datalist id="monthofconfirmation">
				<option value="Jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="July"><option value="Aug"><option value="Sept"><option value="Oct"><option value="Nov"><option value="Dec">
			</datalist>
		<input name="dayofconfirmation" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> size="2" class="user_input" list="dayofconfirmation" placeholder="Day" style="text-transform:uppercase"><br><br>
			<datalist id="dayofconfirmation">
				<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
			</datalist>
			
			CONFIRMATION NAME: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="confirmationname" placeholder="<?php if(@$row){echo $row['Confirmationname'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
			
			CONFIRMATION PLACE: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="placeofconfirmation" placeholder="<?php if(@$row){echo $row['Placeofconfirmation'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
			CONFIRMATION MINISTER: <input size="70" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> name="confirmationminister" placeholder="<?php if(@$row){echo $row['Confirmationminister'];}?>" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		</div>
	</form><br><br>
		<div style="display:flex;width:100%;min-height:30px;background:teal;position:fixed;bottom:0;"><input form="baptismform" type="submit" value="UPDATE" name="update" style="width:60px;height:30px"><input form="baptismform" type="submit" name="home" value="Home" style="width:60px;height:30px;cursor:pointer"><a href="viewprofile3.php" target="_blank" style="text-decoration:none"><input style="height:30px;cursor:pointer" type="button" value="View Parishioner Baptism Profile"></a></div>
	</div>
	
</body>
</html>