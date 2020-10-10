<?php
	session_start();
	
	$_SESSION['formattempt'] = true;
	
	if(isset($_SESSION['error'])){unset($_SESSION['error']);}//delete every stored session error on the start of a new page
	
	$_SESSION['error']=array();//create a session error and initialize it as an array
	
	
	
	$requiredfields=array("baptismnumber","yearofbaptism","monthofbaptism","dayofbaptism","baptismname","othernames","surname","yearofbirth","monthofbirth","dayofbirth","placeofbirth","permaddress","fathername","fatherreligion","mothername","motherreligion","solemn","godfather","godmother","baptismminister");//put all the required input fields into an array
	foreach($requiredfields as $required){
		if(!isset($_POST[$required]) || empty($_POST[$required])){
			$_SESSION['error'][]= $required.' is required';
		}
	}

	validation();
	//place all the text fields that accepts only letters into an array and validate them one by one through iteration using a foreach loop 
	function validation(){
		$textfields= array("baptismname","othernames","surname","permaddress","placeofbirth","fathername","fatherreligion","mothername","motherreligion","godfather","godmother","baptismminister","placeoffhc","fhcminister","confirmationname","placeofconfirmation","confirmationminister");
		foreach($textfields as $text){
			if(!preg_match('/^[A-Za-z ]*$/',@$_POST[$text])){
				$_SESSION['error'][]='Enter letters and whitespace only in $text field';
			}
		}
		
		if(!preg_match('/^[0-9]+$/',@$_POST['baptismnumber'])){
			$_SESSION['error'][]='Enter numbers only in baptismnumber field';
		}
		if(!preg_match('/^[0-9]+$/',@$_POST['yearofbirth'])){
			$_SESSION['error'][]='Enter numbers only in dateofbirth field';
		}
		
		$monthofbirth= array("Jan","Feb","Mar","Apr","May","Jun","July","Aug","Sept","Oct","Nov","Dec");
		if(!in_array(@$_POST['monthofbirth'],$monthofbirth)){
			$_SESSION['error'][]='Enter a valid value in dateofbirth field';
		}
			
		$dayofbirth= array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
		if(!in_array(@$_POST['dayofbirth'],$dayofbirth)){
			$_SESSION['error'][]='Enter a valid value in dateofbirth field';
		}
		
		if(!preg_match('/^[0-9]+$/',@$_POST['yearofbaptism'])){
			$_SESSION['error'][]='Enter numbers only in baptismdate field';
		}
		
		$monthofbaptism= array("Jan","Feb","Mar","Apr","May","Jun","July","Aug","Sept","Oct","Nov","Dec");
		if(!in_array(@$_POST['monthofbaptism'],$monthofbaptism)){
			$_SESSION['error'][]='Enter a valid value in baptismdate field';
		}
			
		$dayofbaptism= array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
		if(!in_array(@$_POST['dayofbaptism'],$dayofbaptism)){
			$_SESSION['error'][]='Enter a valid value in baptismdate field';
		}
		
		$solemn=array("SOLEMN","PRIVATE");
		if(!in_array(@$_POST['solemn'],$solemn)){
			$_SESSION['error'][]='Enter a valid value in solemn/private field';
		}
	}
	
	//final disposition
	//create a table and inserts values into the table if the form is submitted by clicking the post button and if there are no errors returned
	if(isset($_POST['post'])){
		if(count($_SESSION['error']) < 1){
			mysql_connect('localhost','root','')||die('could not connect');
			$query= "CREATE DATABASE IF NOT EXISTS `parish_database`";
			mysql_query($query);
			include "sqliconnect.php";
			unset($_SESSION['formattempt']);
			
			@$baptismnumber= htmlentities(($_POST['baptismnumber']));
			@$baptismname= htmlentities(strtoupper($_POST['baptismname']));																																																																																																																																																																																															
			@$surname= htmlentities(strtoupper($_POST['surname']));
			@$othernames= htmlentities(strtoupper($_POST['othernames']));
			@$fullname= htmlentities(strtoupper($_POST['surname'].' '.$_POST['othernames']));
			@$Permaddress= htmlentities(strtoupper($_POST['permaddress']));
			@$fathername= htmlentities(strtoupper($_POST['fathername']));
			@$fatherreligion= htmlentities(strtoupper($_POST['fatherreligion']));
			@$mothername= htmlentities(strtoupper($_POST['mothername']));
			@$motherreligion= htmlentities(strtoupper($_POST['motherreligion']));
			@$godfather= htmlentities(strtoupper($_POST['godfather']));
			@$godmother= htmlentities(strtoupper($_POST['godmother']));
			@$baptismminister= htmlentities(strtoupper($_POST['baptismminister']));
			@$placeoffhc= htmlentities(strtoupper($_POST['placeoffhc']));
			@$fhcminister= htmlentities(strtoupper($_POST['fhcminister']));
			@$confirmationname= htmlentities(strtoupper($_POST['confirmationname']));
			@$placeofconfirmation= htmlentities(strtoupper($_POST['placeofconfirmation']));
			@$confirmationminister= htmlentities(strtoupper($_POST['confirmationminister']));
			@$solemn= htmlentities(strtoupper($_POST['solemn']));
			@$birthdate=htmlentities($_POST['yearofbirth'].'-'.$_POST['monthofbirth'].'-'.$_POST['dayofbirth']);
			@$baptismdate=htmlentities($_POST['yearofbaptism'].'-'.$_POST['monthofbaptism'].'-'.$_POST['dayofbaptism']);
			@$fhcdate=htmlentities($_POST['yearoffhc'].'-'.$_POST['monthoffhc'].'-'.$_POST['dayoffhc']);
			@$confirmationdate=htmlentities($_POST['yearofconfirmation'].'-'.$_POST['monthofconfirmation'].'-'.$_POST['dayofconfirmation']);
			@$placeofbirth= htmlentities(strtoupper($_POST['placeofbirth']));
		
					//query that creates a table named baptism_table
			$query1= "CREATE table IF NOT EXISTS `baptism_table`(`Baptismnumber` INT NOT NULL PRIMARY KEY,`Baptismname` VARCHAR(255) NOT NULL,`Surname` VARCHAR(255) NOT NULL,`Othernames` VARCHAR(255) NOT NULL,`Fullname` VARCHAR(255) NOT NULL,`Placeofbirth` VARCHAR(255) NOT NULL,`Permaddress` VARCHAR(255) NOT NULL,`Fathername` VARCHAR(255) NOT NULL,`Fatherreligion` VARCHAR(255) NOT NULL,`Mothername` VARCHAR(255) NOT NULL,`Motherreligion` VARCHAR(255) NOT NULL,`Godfather` VARCHAR(255),`Godmother` VARCHAR(255),`Baptismminister` VARCHAR(255) NOT NULL,`Placeoffhc` VARCHAR(255),`Fhcminister` VARCHAR(255),`Confirmationname` VARCHAR(255),`Placeofconfirmation` VARCHAR(255),`Confirmationminister` VARCHAR(255),`Solemn` VARCHAR(255),`Birthdate` VARCHAR(255) NOT NULL,`Baptismdate` VARCHAR(255) NOT NULL,`Fhcdate` VARCHAR(255),`Confirmationdate` VARCHAR(255))Engine=InnoDB DEFAULT CHARSET=UTF8";
			$query_run1= mysqli_query($connect,$query1);//run the create table query
			//if($query_run1){echo "successfulcreate";}else{echo "not successful";}
			
			//insert the form values into the baptism_table
			$query2= "INSERT INTO `baptism_table` VALUES('$baptismnumber','$baptismname','$surname','$othernames','$fullname','$placeofbirth','$Permaddress','$fathername','$fatherreligion','$mothername','$motherreligion','$godfather','$godmother','$baptismminister','$placeoffhc','$fhcminister','$confirmationname','$placeofconfirmation','$confirmationminister','$solemn','$birthdate','$baptismdate','$fhcdate','$confirmationdate')";
			$query_run2= mysqli_query($connect,$query2);//run the insert query
			
			if($query_run2){echo "<h3 style='color:green'>successfully inserted</h3>";}else{echo "<h3 style='color:red'>unsuccessful</h3>";}
			
		
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
		.active{
			display:none;
		}
		.user_input{
			height:22px;
			font-size: 1.2em;
		}
	</style>
</head>
<body>
	<div style="display:flex;position:fixed;background:teal;min-height:50px;width:100%">
		<input type="checkbox" disabled id="baptism_checkbox" checked style="margin-left:20px;width:20px;height:20px"><label for="baptism_checkbox">BAPTISM</label>
		<input type="checkbox" id="fhc_checkbox" style="margin-left:20px;width:20px;height:20px"><label for="fhc_checkbox">FHC</label>
		<input type="checkbox" id="confirmation_checkbox" style="margin-left:20px;width:20px;height:20px"><label for="confirmation_checkbox">CONFIRMATION</label>
		<!--<input type="checkbox" id="marriage_checkbox" style="margin-left:20px;"><label for="marriage_checkbox">Marriage</label>-->
	</div><br><br>
	<div id="baptismcontainer" style="padding-left:20px;padding-top:30px">
		<div style="width:100%;height:1px;background:black"></div>
		<p style="color:lightseagreen">BAPTISM>>></p>
		<div style="width:100%;height:1px;background:black"></div><br><br>
		
		<div id="showerrors" style="color:red;">
			<?php 
				if(isset($_POST['post'])){
					if(isset($_SESSION['error']) && isset($_SESSION['formattempt'])){
						if(count($_SESSION['error']) > 0){
							unset($_SESSION['formattempt']);
							echo "FORM NOT SUBMITTED<br>";
							echo "Errors encountered:<br>";
							foreach($_SESSION['error'] as $error){
								echo $error."<br>\n";
							}
						}	
					}
				}
			?>
		</div>	
	<form action="baptism_insert.php" method="POST" id="baptismform">
		BAPTISM NUMBER:<input size="10" id="num" name="baptismnumber" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		BAPTISM DATE:
		<input name="yearofbaptism" size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
		<select name="monthofbaptism" class="user_input" style="text-transform:uppercase">
			<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
		</select>
		<select name="dayofbaptism" class="user_input" style="text-transform:uppercase"><br><br>
			<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
		</select><br><br>
		
		BAPTISM NAME: <input size="70" name="baptismname" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		OTHER NAMES: <input size="70" name="othernames" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		SURNAME: <input size="70" name="surname" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		DATE OF BIRTH:
				<input name="yearofbirth" size="4" class="user_input" type="text" placeholder="Year" style="height:22px;margin-left:10px;text-transform:uppercase">
				<select name="monthofbirth" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
				</select>
				<select name="dayofbirth" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
				</select><br><br>
		
		PLACE OF BIRTH: <input size="70" name="placeofbirth" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		PERMANENT ADDRESS: <input size="70" name="permaddress" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		FATHER'S NAME: <input size="70" name="fathername" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		FATHER'S RELIGION: <input size="70" name="fatherreligion" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		MOTHER'S NAME: <input size="70" name="mothername" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		MOTHER'S RELIGION: <input size="70" name="motherreligion" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		SOLEMN/PRIVATE: <select name="solemn" class="user_input" style="margin-left:10px;text-transform:uppercase">
				<option value="SOLEMN">SOLEMN</option>
				<option value="PRIVATE">PRIVATE</option>
				</select><br><br>
		GOD FATHER: <input size="70" name="godfather" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>

		GOD MOTHER: <input size="70" name="godmother" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
	
		BAPTISM MINISTER: <input size="70" name="baptismminister" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
		
		<div class="fhccontainer active">
			<div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">FHC>>></p>
			<div style="width:100%;height:1px;background:black"></div><br><br>
			
		FHC DATE:
		<input name="yearoffhc" size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
		<select name="monthoffhc" class="user_input" style="text-transform:uppercase">
				<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
		</select>
		<select name="dayoffhc" class="user_input" style="text-transform:uppercase"><br><br>
			<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
		</select><br><br>
			
			PLACE: <input size="70" name="placeoffhc" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
			MINISTER: <input size="70" name="fhcminister" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		</div>
		
		
		<div class="confirmationcontainer active">
			<div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">CONFIRMATION>>></p>
			<div style="width:100%;height:1px;background:black"></div><br><br>
			
		CONFIRMATION DATE:
		<input name="yearofconfirmation" size="4" class="user_input" type="text" placeholder="Year" style="margin-left:10px;text-transform:uppercase">
		<select name="monthofconfirmation" class="user_input" style="text-transform:uppercase">
			<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
		</select>
		<select name="dayofconfirmation" class="user_input" style="text-transform:uppercase"><br><br>
			<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
		</select><br><br>
			
			Confirmation Name: <input size="70" name="confirmationname" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
			
			PLACE: <input size="70" name="placeofconfirmation" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		
			MINISTER: <input size="70" name="confirmationminister" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>
		</div>
	</form><br><br>
	<div style="display:flex;width:100%;min-height:30px;background:teal;position:fixed;bottom:0;"><input form="baptismform" type="submit" value="POST" name="post" style="width:60px;height:30px"><input form="baptismform" type="reset" value="Clear all" style="width:60px;height:30px"><a href="baptism_homepage.html"><button style="width:60px;height:30px;cursor:pointer">Home</button></a></div>
	</div>
	
	<script>
		var fhccontainer= document.getElementsByClassName("fhccontainer");
		var fhc_checkbox= document.getElementById("fhc_checkbox");
		fhc_checkbox.onclick= function(){fhccontainer[0].classList.toggle('active');};
		
		var confirmationcontainer= document.getElementsByClassName("confirmationcontainer");
		var confirmation_checkbox= document.getElementById("confirmation_checkbox");
		confirmation_checkbox.onclick= function(){confirmationcontainer[0].classList.toggle('active');};
	</script>
</body>
</html>