<?php
	session_start();
	
	//session_destroy();
	//unset($_SESSION['num_rows']);
	//validate the top fields(full name and regno)
	/*
	if(isset($_POST['fullnameandregno_submit'])){
		$_SESSION['num_rows']= true;
	}*/
		
			
			if(isset($_POST['fullname']) && isset($_POST['regno']) && !empty($_POST['fullname']) && !empty($_POST['regno'])){
				
				//$fullname= $_POST['fullname'];
				//$regno= $_POST['regno'];
				
				if(preg_match('/^[a-zA-Z ]+$/',$_POST['fullname']) && preg_match('/^[0-9]+$/',$_POST['regno'])){
					$fullname= $_POST['fullname'];
					$regno= $_POST['regno'];
					$num_rows= true;
					/*
					include "sqliconnect.php";
					$query1= "SELECT `Fullname`,`Regno` FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
					$query_run1= mysqli_query($connect,$query1);
					if(mysqli_num_rows($connect,$query_run1) > 0){
						//create a session that indicates that the top fields have been validated(DB contains the fullname and regno values entered)
							//$_SESSION['num_rows']= true;
							$query2= "SELECT * FROM `parishioner_profile` WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
							$query_run2= mysqli_query($connect,$query2);
							$row= mysqli_fetch_array($connect,$query2,MYSQLI_ASSOC);
					}*/
				}
			}
	/*	
	updateSurname();
	updateOtherNames();
	updatecurrentAddress();
	updategsmNumber();
	updateofficeTelephone();
	updatehomeTelephone();
	*/
	
	//validate the fields in the personal section

		if(isset($_POST['updatesurname'])){
			echo $regno;
			if($num_rows){
				if(isset($_POST['surname'])&&!empty($_POST['surname'])){
					include "sqliconnect.php";
					$surname= $_POST['surname'];
					echo $surname;
					if(preg_match('/^[a-zA-Z ]+$/',$surname)){
						$updatesurname= "UPDATE `parishioner_profile` SET `Surname`='$surname' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatesurname);
					}
				}
			}
		}
	
	function updateOtherNames(){
		//validate the fields in the personal section
		if(isset($_POST['updateothernames'])){
			//echo $_POST['fullname'];
			if($num_rows){
				if(isset($_POST['othernames'])&&!empty($_POST['othernames'])){
					$othernames= $_POST['othernames'];
					if(preg_match('/^[a-zA-Z ]+$/',$othernames)){
						$updateothernames= "UPDATE `parishioner_profile` SET `Othernames`='$othernames' WHERE `Fullname`='{$_POST['fullname']}' AND `Regno`= '{$_POST['regno']}'";
						mysqli_query($connect,$updateothernames);
					}
				}
			}
		}
	}
	function updatecurrentAddress(){
		//validate the fields in the personal section

				if(isset($_POST['currentaddress'])&&!empty($_POST['currentaddress'])){
					$currentaddress= $_POST['currentaddress'];
					if(preg_match('/^[a-zA-Z ]+$/',$currentaddress)){
						$updatecurrentaddress= "UPDATE `parishioner_profile` SET `Currentaddress`='$currentaddress' WHERE `Fullname`= '$fullname' AND `Regno`= '$regno'";
						mysqli_query($connect,$updatecurrentaddress);
					}
				}

	}
	function updategsmNumber(){
		//validate the fields in the personal section
		if(isset($_POST['updategsmnumber'])){
			if($num_rows){
				if(isset($_POST['gsmnumber'])&&!empty($_POST['gsmnumber'])){
					$gsmnumber= $_POST['gsmnumber'];
					if(preg_match('/^[a-zA-Z ]+$/',$gsmnumber)){
						$updategsmnumber= "UPDATE `parishioner_profile` SET `Gsmnumber`='$gsmnumber' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updategsmnumber);
					}
				}
			}
		}
	}
		function updateofficeTelephone(){
		//validate the fields in the personal section
		if(isset($_POST['updateofficetelephone'])){
			if($num_rows){
				if(isset($_POST['officetelephone'])&&!empty($_POST['officetelephone'])){
					$officetelephone= $_POST['officetelephone'];
					if(preg_match('/^[a-zA-Z ]+$/',$officetelephone)){
						$updateofficetelephone= "UPDATE `parishioner_profile` SET `Officetelephone`='$officetelephone' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updateofficetelephone);
					}
				}
			}
		}
	}
		function updatehomeTelephone(){
		//validate the fields in the personal section
		if(isset($_POST['updatehometelephone'])){
			if($num_rows){
				if(isset($_POST['hometelephone'])&&!empty($_POST['hometelephone'])){
					$hometelephone= $_POST['hometelephone'];
					if(preg_match('/^[a-zA-Z ]+$/',$hometelephone)){
						$updatehometelephone= "UPDATE `parishioner_profile` SET `Hometelephone`='$hometelephone' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatehometelephone);
					}
				}
			}
		}
	}
		function gsm(){
		//validate the fields in the personal section
		if(isset($_POST['email'])){
			if($num_rows){
				if(isset($_POST['currentaddress'])&&!empty($_POST['currentaddress'])){
					$currentaddress= $_POST['currentaddress'];
					if(preg_match('/^[a-zA-Z ]+$/',$currentaddress)){
						$updatecurrentaddress= "UPDATE `parishioner_profile` SET `Currentaddress`='$currentaddress' WHERE `Fullname`='$fullname' AND `Regno`='$regno'";
						mysqli_query($connect,$updatecurrentaddress);
					}
				}
			}
		}
	}
?>

<!Doctype html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		*{
			margin:0;
			padding:0;
		}
		#container{
			width:800px;
		}
	</style>
</head>
<body>
	<div id="container">
			<h1 style="width:100%;color:ghostwhite;background:linear-gradient(to right,#13547a 50%,#80d0c7 100%);font-family:helvetica;min-height:80px;min-width:300px;padding:10px 0 10px 20px;text-transform:uppercase">update/view personal record interface</h1><br><br>

				<form id="form1" style="display:flex;padding-left:20px" action="updateform.php" method="POST">
					<input value="<?php if(isset($_POST['fullname']) && !empty($_POST['fullname'])){echo $_POST['fullname'];}?>" style="background:lightblue;text-transform:uppercase" type="text" name="fullname" size="80" placeholder="Type the name of the parishioner starting with the surname...">
					<input value="<?php if(isset($_POST['regno']) && !empty($_POST['regno'])){echo $_POST['regno'];}?>" type="text" size="8" name="regno" placeholder="regno.." style="margin-left:20px;background:lightblue;text-transform:uppercase">
					<input name="fullnameandregno_submit" type="submit" value="&#10095;" style="min-height:16px;min-width:30px;border-radius:20%;">
				</form><br>
				<!--if(isset($_POST['fullname']) && isset($_POST['regno']) && !empty($_POST['fullname']) && !empty($_POST['regno']))-->
				
				<div style="width:100%;height:1px;background:black;margin-left:20px"></div><br>
				<a href="#" style="padding-left:20px"><input type="button" value="View Individual Profile" style="min-height:30px;min-width:30px;cursor:pointer;"></a><br><br>
				
				
				<div style="display:flex;padding-left:20px">
					Life Status:&nbsp;
					<select>
						<option value="Active">Active</option>
						<option value="Deceased">Deceased</option>
					</select>&nbsp;&nbsp;
					<div><?php //display the fullname of the parishioner after first validation(fullname and regno confirmed present in the DB) ?></div>
				</div><br>
				
				<div style="width:100%;height:1px;background:black;margin-left:20px"></div><br>
				<div style="width:100%;height:1px;background:black;margin-left:20px"></div><br><br>
				
				
				<div style="display:flex;padding-left:20px">
					<div>
					New Entry Date:
					<input name="yearofentry" size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
					<input name="monthofentry" size="3" class="user_input" list="monthofentry" placeholder="Mon" style="text-transform:uppercase">
					<datalist id="monthofentry">
						<option value="jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="Jul"><option value="Aug"><option value="Sep"><option value="Oct"><option value="Nov"><option value="Dec">
					</datalist>
					<input name="dayofentry" size="2" class="user_input" list="dayofentry" placeholder="Day" style="text-transform:uppercase"><br><br>
					<datalist id="dayofentry">
						<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
					</datalist>
					</div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div>Entry date as entered in the database:&nbsp;<input type="text" size="12"><?php //display the entry date stored in the DB after first validation(fullname and regno confirmed present in the DB)?></div>
				</div>
				
				<div style="padding-left:20px" id="departuredate_div">
					Date of departure:
					<input name="yearofdeparture" size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
					<input name="monthofdeparture" size="3" class="user_input" list="monthofdeparture" placeholder="Mon" style="text-transform:uppercase">
					<datalist id="monthofdeparture">
						<option value="jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="Jul"><option value="Aug"><option value="Sep"><option value="Oct"><option value="Nov"><option value="Dec">
					</datalist>
					<input name="dayofdeparture" size="2" class="user_input" list="dayofdeparture" placeholder="Day" style="text-transform:uppercase"><br><br>
					<datalist id="dayofdeparture">
						<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
					</datalist>
				</div><br><br>
				
				
			<div style="padding-left:30px;">
				<br><div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">PERSONAL INFORMATION >>></p>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				<div id="showerrors" style="color:red;">
				
					<?php 
					/*
					if(isset($_POST['post'])){
						if(isset($_SESSION['error']) && isset($_SESSION['formattempt'])){
							unset($_SESSION['formattempt']);
							echo "Errors encountered:<br>";
							foreach($_SESSION['error'] as $error){
								echo $error."<br>\n";
							}
						}	
					}*/
					?>
				</div>
				
				Title:<input name="title" class="user_input" list="title" size="6" style="margin-left:76px;text-transform:uppercase" <?php /*if(!isset($regno) || empty($regno)){echo "disabled";}elseif(isset($regno) && !empty($regno)){if(preg_match('/^[0-9]+$/',$regno)){"";}else{echo "disabled";}}*/?> />
				&nbsp;&nbsp;&nbsp;
				Sex:<input name="sex" class="user_input" list="sex" size="6" style="margin-left:10px;text-transform:uppercase">
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
				<form style="display:flex" action="updateform.php" method="POST">
					Surname:<input form="form1" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$num_rows){echo "surname";}//if(@$row){echo $row['Surname'];}?>" size="50" name="surname" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase">
					<input form="form1" type="submit" value="update" name="updatesurname" style="min-height:16px;min-width:30px;">
				</form><br>
				
					Baptism Name:<input size="50" name="baptismname" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Other Names:<input form="form1" <?php if(@$num_rows){echo "";}else{echo "disabled";}?> placeholder="<?php if(@$row){echo $row['Surname'];}?>" size="50" name="othernames" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase">
					<input form="form1" type="submit" value="update" name="updateothernames" style="min-height:16px;min-width:30px;">
				</form><br>
				
				Date of Birth:
				<input name="yearofbirth" size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
				<input name="monthofbirth" size="3" class="user_input" list="monthofbirth" placeholder="Mon" style="text-transform:uppercase">
				<datalist id="monthofbirth">
					<option value="jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="Jul"><option value="Aug"><option value="Sep"><option value="Oct"><option value="Nov"><option value="Dec">
				</datalist>
				<input name="dayofbirth" size="2" class="user_input" list="dayofbirth" placeholder="Day" style="text-transform:uppercase"><br><br>
				<datalist id="dayofbirth">
					<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
				</datalist>
				
				Place of Birth:<input size="50" name="placeofbirth" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"/></input><br><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Current Address:<input size="50" name="currentaddress" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase">
					<input type="submit" value="update" name="updatecurrentaddress" style="min-height:16px;min-width:30px;">
				</form><br>
				
				Perm Address:<input size="50" name="permaddress" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
				State of Origin:<input size="10" name="stateoforigin" class="user_input" list="state" style="text-transform:uppercase"><br><br>
				<datalist id="state">
					<option value="Abia"><option value="Adamawa"><option value="Anambra"><option value="Bauchi"><option value="Bayelsa"><option value="Benue"><option value="Borno"><option value="Crossriver"><option value="Delta"><option value="Ebonyi"><option value="Edo"><option value="Ekiti"><option value="Enugu"><option value="FCt(Abuja)"><option value="Gombe"><option value="Imo"><option value="Jigawa"><option value="Kaduna"><option value="Kano"><option value="Katsina"><option value="Kebbi"><option value="Kogi"><option value="Kwara"><option value="Lagos"><option value="Nassarawa"><option value="Niger"><option value="Ogun"><option value="Ondo"><option value="Osun"><option value="Oyo"><option value="Plateau"><option value="Rivers"><option value="Sokoto"><option value="Taraba"><option value="Yobe"><option value="Zamfara">
				</datalist>
				
				<form style="display:flex" action="updateform.php" method="POST">
					<div style="display:inline-block;">GSM Number:&nbsp;<input name="gsmnumber" class="user_input" type="tel" style="text-transform:uppercase"></div>
					<input type="submit" value="update" name="updategsmnumber" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					<div style="display:inline-block;">Office Telephone:&nbsp;<input name="officetelephone" class="user_input" type="tel" style="text-transform:uppercase"></div>
					<input type="submit" value="update" name="updateofficetelephone" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					<div style="display:inline-block;">Home Telephone:&nbsp;<input name="hometelephone" class="user_input" type="tel" style="text-transform:uppercase"></div>
					<input type="submit" value="update" name="updatehometelephone" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Email:<input name="email" class="user_input" type="email" size="50" style="margin-left:10px;text-transform:uppercase">
					<input type="submit" value="update" name="updatecurrentaddress" style="min-height:16px;min-width:30px;">
				</form><br/>
				
				<form style="display:flex" action="updateform.php" method="POST">
					<div style="display:inline-block;">Primary Occupation:&nbsp;<input name="primaryoccupation" class="user_input" list="primaryoccupation" style="text-transform:uppercase"></div>
						<datalist id="primaryoccupation">
							<option value="Administrator"><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value=""><option value="">
						</datalist>
					<input type="submit" value="update" name="updateprimaryoccupation" style="min-height:16px;min-width:30px;">
				</form><br/>
				
				<div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">MARITAL STATUS</p>
				<div style="width:100%;height:1px;background:black"></div><br/>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Marital status:&nbsp;<input list="maritalid" name="maritalstatus" placeholder="single" style="text-transform:uppercase;">
					<datalist id="maritalid">
						<option value="single">
						<option value="married">
					</datalist>
					<input type="submit" value="update" name="updatemaritalstatus" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Spouse's Baptism Name: <input disabled size="50" name="spousebaptismname" class="spouseuser_input" type="text" style="margin-left:10px;text-transform:uppercase">
					<input type="submit" value="update" name="updatespousebaptismname" style="min-height:16px;min-width:30px;">
				</form><br>
					
				<form style="display:flex" action="updateform.php" method="POST">	
					Spouse's Other Names: <input disabled size="50" name="spouseothernames" class="spouseuser_input" type="text" style="margin-left:10px;text-transform:uppercase">
					<input type="submit" value="update" name="updatespouseothernames" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">				
					Date of Marriage:
					<input name="yearofmarriage" disabled size="4" class="spouseuser_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
					<input name="monthofmarriage" disabled size="3" class="spouseuser_input" list="monthofmarriage" placeholder="Mon" style="text-transform:uppercase">
					<datalist id="monthofmarriage">
						<option value="jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="Jul"><option value="Aug"><option value="Sep"><option value="Oct"><option value="Nov"><option value="Dec">
					</datalist>
					<input name="dayofmarriage" disabled size="2" class="spouseuser_input" list="dayofmarriage" placeholder="Day" style="text-transform:uppercase"><br>
					<datalist id="dayofmarriage">
						<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
					</datalist>
					<input type="submit" value="update" name="updatedateofmarriage" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Place of Marriage:<input size="50" disabled name="placeofmarriage" class="spouseuser_input" type="text" style="margin-left:10px;text-transform:uppercase">
					<input type="submit" value="update" name="updateplaceofmarriage" style="min-height:16px;min-width:30px;">
				</form><br>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Number of Children (under 21):<input id="childrennumberinput" name="numberofchildren" size="3" list="numberofchildren" style="margin-left:10px">
					<datalist id="numberofchildren">
						<option value="1"><option value="2"><option value="3"><option value="4"><option value="5">
					</datalist>
						<input type="submit" value="update" name="updatenumberofchildren" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Name of children:&nbsp;<textarea class="childrenname_input" name="nameofchildren" cols="50" rows="5" style="text-transform:uppercase;"></textarea>
					<input type="submit" value="update" name="updatenameofchildren" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Year of Church Membership:<input name="yearofchurchmembership"  form="parishioner_profileform" size="4" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
					<input type="submit" value="update" name="updateyearofchurchmembership" style="min-height:16px;min-width:30px;">
				</form><br>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Active societies:<input form="parishioner_profileform" id="societynumberinput" name="numberofsocieties" size="3" list="numberofsocieties" style="margin-left:10px;">
					<datalist id="numberofsocieties">
						<option value="1"><option value="2"><option value="3"><option value="4"><option value="5"><option value="6">
					</datalist>
					<input type="submit" value="update" name="updatenumberofsocieties" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Name of societies:&nbsp;<textarea form="parishioner_profileform" class="societiesname_input" name="nameofsocieties" cols="50" rows="5" style="text-transform:uppercase;"></textarea>
					<input type="submit" value="update" name="updatenameofsocieties" style="min-height:16px;min-width:30px;">
				</form><br>
				
				<form style="display:flex" action="updateform.php" method="POST">
					Comments:<br><textarea  form="parishioner_profileform" name="comments" cols="60" rows="10" class="user_input"></textarea>
						<input type="submit" value="update" name="updatenameofsocieties" style="min-height:16px;min-width:30px;">
				</form><br><br>
				<div style="display:flex;width:100%;min-height:30px;background:teal;position:fixed;bottom:0;"><input form="parishioner_profileform" type="submit" value="POST" name="post" style="width:60px;height:30px"><input form="parishioner_profileform" type="reset" value="Clear all" style="width:60px;height:30px"><a href="#"><button style="width:60px;height:30px;cursor:pointer">Home</button></a></div>
			
			</div>								
	</div>
</html>