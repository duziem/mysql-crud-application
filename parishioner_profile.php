<?php
	$entrydate = date('Y-M-d',time());
/*	
	if(isset($regno) && !empty($regno)){
		if(preg_match('/^[0-9]+$/',$regno)){
			include "sqliconnect.php";
			$query= "CREATE table IF NOT EXISTS `regno_temp`(`regno` int unsigned NOT NULL)";
			$querycreate= mysqli_query($connect,$query);
			$query= "UPDATE `regno_temp` SET `regno`='$regno' WHERE 1";
			$queryinsert= mysqli_query($connect,$query);
			if($querycreate && $queryinsert){echo 'successful';}else{echo 'unsuccessful';}
		}
	}*/
	session_start();
	
	$_SESSION['formattempt'] = true;
	
	if(isset($_SESSION['error'])){unset($_SESSION['error']);}//delete every stored session error on the satrt of a new page
	
	$_SESSION['error']=array();//create a session error and initialize it as an array
	
	
	//put all the required input fields into an array
	$requiredfields=array("parishregno","title","sex","surname","baptismname","othernames","yearofbirth","monthofbirth","dayofbirth","placeofbirth","currentaddress","permaddress","stateoforigin","maritalstatus","yearofchurchmembership");
	foreach($requiredfields as $required){
		if(!isset($_POST[$required]) || empty($_POST[$required])){
			$_SESSION['error'][]= $required.' is required';
		}
	}
	
	//validate the created fields to ensure that they contain the corrcect information
	function validation(){
		$titlearray = array("Mr","Mrs","Sir","Lady","Chief","Lolo","Pro.","Dr","Engr","Barr","Comrade","Madam","PA");
		if(!in_array(@$_POST['title'],$titlearray)){
			$_SESSION['error'][]='Enter a valid value in title field';
		}
		$sex=array("M","F");
		if(!in_array(@$_POST['sex'],$sex)){
			$_SESSION['error'][]='Enter a valid value in sex field';
		}
		if(!preg_match('/^[A-Za-z ]+$/',@$_POST['surname'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Surname field';
		}
		if(!preg_match('/^[A-Za-z ]+$/',@$_POST['baptismname'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Baptism name field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['othernames'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Other names field';
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
		
		if(!preg_match('/^[A-Za-z ]+$/',@$_POST['placeofbirth'])){
			$_SESSION['error'][]='Enter letters and whitespace only in placeofbirth field';
		}
		if(!preg_match('/^[A-Za-z0-9, ]+$/',@$_POST['currentaddress'])){
			$_SESSION['error'][]='Enter letters and whitespace only in current address field';
		}
		if(!preg_match('/^[A-Za-z0-9, ]+$/',@$_POST['permaddress'])){
			$_SESSION['error'][]='Enter letters and whitespace only in perm address field';
		}
		if(!preg_match('/^[A-Za-z ]+$/',@$_POST['stateoforigin'])){
			$_SESSION['error'][]='Enter letters and whitespace only in stateoforigin field';
		}
		if(!preg_match('/^[0-9+]*$/',@$_POST['gsmnumber'])){
			$_SESSION['error'][]='Enter numbers only in GSM number field';
		}
		if(!preg_match('/^[0-9+]*$/',@$_POST['officetelephone'])){
			$_SESSION['error'][]='Enter numbers only in Office Telephone field';
		}
		if(!preg_match('/^[0-9+]*$/',@$_POST['hometelephone'])){
			$_SESSION['error'][]='Enter numbers only in Home Telephone field';
		}
		/*
		if(!filter_var(@$_POST['email'],FILTER_VALIDATE_EMAIL)){
			$_SESSION['error'][]='Enter a valid emailaddress in Email field';
		}*/
		
		$maritalstatus = array("single","married");
		if(!in_array(@$_POST['maritalstatus'],$maritalstatus)){
			$_SESSION['error'][]='Enter a valid value in Marital Status field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['spousebaptismname'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Spouse\'s Baptism Name field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['spouseothernames'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Spouse\'s Other Names field';
		}
		if(!preg_match('/^[0-9]*$/',@$_POST['yearofmarriage'])){
			$_SESSION['error'][]='Enter numbers only in dateofmarriage field';
		}
		
		$monthofmarriage= array("Jan","Feb","Mar","Apr","May","Jun","July","Aug","Sept","Oct","Nov","Dec","");
		if(!in_array(@$_POST['monthofmarriage'],$monthofmarriage)){
			$_SESSION['error'][]='Enter a valid value in dateofmarriage field';
		}
			
		$dayofmarriage= array("","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
		if(!in_array(@$_POST['dayofmarriage'],$dayofmarriage)){
			$_SESSION['error'][]='Enter a valid value in dateofmarriage field';
		}
		
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['placeofmarriage'])){
			$_SESSION['error'][]='Enter letters and whitespace only in placeofmarriage field';
		}
		$numberofchildren = array("1","2","3","4","5","");
		if(!in_array(@$_POST['numberofchildren'],$numberofchildren)){
			$_SESSION['error'][]='Enter a valid value in Number of Children field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofchildren1'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Children field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofchildren2'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Children field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofchildren3'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Children field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofchildren4'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Children field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofchildren5'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Children field';
		}
		if(!preg_match('/^[0-9]*$/',@$_POST['yearofchurchmembership'])){
			$_SESSION['error'][]='Enter numbers only in yearofchurchmembership field';
		}
		$activesocieties = array("1","2","3","4","5","6","");
		if(!in_array(@$_POST['numberofsocieties'],$activesocieties)){
			$_SESSION['error'][]='Enter a valid value in Active Societies field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofsocieties1'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Societies field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofsocieties2'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Societies field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofsocieties3'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Societies field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofsocieties4'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Societies field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofsocieties5'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Societies field';
		}
		if(!preg_match('/^[A-Za-z ]*$/',@$_POST['nameofsocieties6'])){
			$_SESSION['error'][]='Enter letters and whitespace only in Name of Societies field';
		}
	}
	
	
	//final disposition
	//create a table on the condition that it does not exist and inserts values into the table if the form is submitted by clicking the post button and if there are no errors returned
	if(isset($_POST['post'])){
		if(count($_SESSION['error']) < 1){
			validation();
			mysql_connect('localhost','root','')||die('could not connect');
			$query= "CREATE DATABASE IF NOT EXISTS `parish_database`";
			mysql_query($query);
			include "sqliconnect.php";

			unset($_SESSION['formattempt']);
			
			$Entrydate= htmlentities($_POST['entrydate']);
			$birthyear= htmlentities($_POST['yearofbirth']);
			$age= substr($Entrydate, 0, 4) - $birthyear;
			$regno= htmlentities($_POST['parishregno']);
			@$title= htmlentities(strtoupper($_POST['title']));
			@$sex= htmlentities(strtoupper($_POST['sex']));
			@$surname= htmlentities(strtoupper($_POST['surname']));
			@$baptismname= htmlentities(strtoupper($_POST['baptismname']));
			@$othernames= htmlentities(strtoupper($_POST['othernames']));
			@$fullname= htmlentities(strtoupper($_POST['surname'].' '.$_POST['othernames']));
			@$birthdate=htmlentities($_POST['yearofbirth'].'-'.$_POST['monthofbirth'].'-'.$_POST['dayofbirth']);
			@$birthplace= htmlentities(strtoupper($_POST['placeofbirth']));
			@$curaddress= htmlentities(strtoupper($_POST['currentaddress']));
			@$permaddress= htmlentities(strtoupper($_POST['permaddress']));
			@$state= htmlentities(strtoupper($_POST['stateoforigin']));
			@$gsmno= htmlentities($_POST['gsmnumber']);
			@$officetel= htmlentities($_POST['officetelephone']);
			@$hometel= htmlentities($_POST['hometelephone']);
			@$email= htmlentities($_POST['email']);
			@$prijob= htmlentities(strtoupper($_POST['primaryoccupation']));
			@$secjob= htmlentities(strtoupper($_POST['secondaryoccupation']));
			@$marital= htmlentities(strtoupper($_POST['maritalstatus']));
			@$spousebaptismname= htmlentities(strtoupper($_POST['spousebaptismname']));
			@$spouseothername= htmlentities(strtoupper($_POST['spouseothernames']));
			@$marriagedate=htmlentities($_POST['yearofmarriage'].'-'.$_POST['monthofmarriage'].'-'.$_POST['dayofmarriage']);
			@$marriageplace= htmlentities(strtoupper($_POST['placeofmarriage']));
			@$children_number= htmlentities($_POST['numberofchildren']);
			@$children_name= htmlentities(strtoupper($_POST['nameofchildren1'].' '.$_POST['nameofchildren2'].' '.$_POST['nameofchildren3'].' '.$_POST['nameofchildren4'].' '.$_POST['nameofchildren5']));
			@$membershipyr= htmlentities($_POST['yearofchurchmembership']);
			@$societies= htmlentities($_POST['numberofsocieties']);
			@$societyname= htmlentities(strtoupper($_POST['nameofsocieties1'].' '.$_POST['nameofsocieties2'].' '.$_POST['nameofsocieties3'].' '.$_POST['nameofsocieties4'].' '.$_POST['nameofsocieties5'].' '.$_POST['nameofsocieties6']));
			@$comments= htmlentities(strtoupper($_POST['comments']));
			
			
			//query that creates a table named parishioner_profile
			$query1= "CREATE table IF NOT EXISTS `parishioner_profile`(`Entrydate` VARCHAR(255) NOT NULL,`Regno` INT unsigned NOT NULL PRIMARY KEY,`Title` VARCHAR(9) NOT NULL,`Sex` char(1) NOT NULL,`Surname` VARCHAR(255) NOT NULL,`Baptismname` VARCHAR(255) NOT NULL,`Othernames` VARCHAR(255) NOT NULL,`Fullname` VARCHAR(255) NOT NULL,`Age` INT unsigned NOT NULL,`Dateofbirth` VARCHAR(255) NOT NULL,`Placeofbirth` VARCHAR(255) NOT NULL,`Currentaddress` VARCHAR(255) NOT NULL,`Permaddress` VARCHAR(255) NOT NULL,`Stateoforigin` VARCHAR(255) NOT NULL,`Gsmnumber` VARCHAR(255),`Officetelephone` VARCHAR(255),`Hometelephone` VARCHAR(255),`Email` VARCHAR(255),`Primaryoccupation` VARCHAR(255),`Secondaryoccupation` VARCHAR(255),`Maritalstatus` VARCHAR(255) NOT NULL,`Spousebaptismname` VARCHAR(255),`Spouseothernames` VARCHAR(255),`Dateofmarriage` VARCHAR(255),`Placeofmarriage` VARCHAR(255),`Numberofchildren` INT(2) unsigned,`Nameofchildren` VARCHAR(255),`Yearofmembership` INT(4) unsigned NOT NULL,`Activesocieties` INT(2) unsigned,`Nameofsocieties` VARCHAR(255),`Lifestatus` VARCHAR(255),`Departuredate` VARCHAR(255),`Comments` TEXT(2000))Engine=InnoDB DEFAULT CHARSET=UTF8";
			$query_run1= mysqli_query($connect,$query1);//run the create table query
			//if($query_run1){echo "successfulcreate";}
			
			//insert the form values into the parishioner_profile table
			$query2= "INSERT INTO `parishioner_profile` VALUES('$Entrydate','$regno','$title','$sex','$surname','$baptismname','$othernames','$fullname','$age','$birthdate','$birthplace','$curaddress','$permaddress','$state','$gsmno','$officetel','$hometel','$email','$prijob','$secjob','$marital','$spousebaptismname','$spouseothername','$marriagedate','$marriageplace','$children_number','$children_name','$membershipyr','$societies','$societyname','ACTIVE','','$comments')";
			$query_run2= mysqli_query($connect,$query2);//run the insert query
			
			if($query_run2){echo "<h3 style='color:green'>successfully inserted</h3>";}else{echo "<h3 style='color:red'>unsuccessful</h3>";}
			}
		}
		
	?>
<!Doctype html>
<html>
<head>
	<title>Enter Parishioner Information</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<style>
		*{
			margin:0;
			padding:0;
		}
		#container{
			width:100%;
		}
		#regno{
			height:22px;
			font-size: 1.2em;
		}
		.societiesname_input{
			height:22px;
			font-size: 1.2em;
			text-transform:uppercase;
		}
		.childrenname_input{
			height:22px;
			font-size: 1.2em;
			text-transform:uppercase
		}
		.spouseuser_input{
			font-size: 1.2em;
		}
		.user_input{
			font-size: 1.2em;
			/*height:22px;*/
		}
	</style>
</head>
<body>
	<div id="container">
			<h1 id="entryinterface_heading" style="width:100%;color:ghostwhite;background:linear-gradient(to right,#13547a 50%,#80d0c7 100%);font-family:helvetica;min-height:80px;min-width:300px;padding:10px 0 10px 20px;text-transform:uppercase">new record entry interface</h1><br>
			<div style="padding-left:30px;">
			
				<hr>				
				<div style="font-weight:bold;display:inline-block;color:red">Entry Date:&nbsp;<input name="entrydate" form="parishioner_profileform" type="text" value="<?php echo $entrydate;?>" readonly></div>
				
				<!--<form id="regnoform" action="parishioner_profile.php" method="POST" style="float:right;display:inline-block;font-weight:bold">Parish Registration no: <input value="<?php //if(isset($regno) && !empty($regno)){if(preg_match('/^[0-9]+$/',$regno)){echo $regno;}}?>" id="regno" name="parishregno" autofocus type="text" size="6" form="parishioner_profileform" title="Accepts numbers only">
				<input id="button" form="parishioner_profileform" novalidation name="submit" type="submit" value="&#10095;" style="float:right;display:inline-block;min-height:16px;min-width:30px;border-radius:20%;"><div style="color:red"><?php //if(isset($regno) && !empty($regno)){if(!preg_match('/^[0-9]+$/',$regno)){echo 'Enter numbers only';}}?></div></form>-->
			
				<div id="regnoform" style="float:right;display:inline-block;font-weight:bold">Parish Registration no: <input id="regno" name="parishregno" autofocus type="text" size="8" form="parishioner_profileform" title="Accepts numbers only">
				<!--<input id="regnobutton" name="submit" type="button" value="&#10095;" style="float:right;display:inline-block;min-height:16px;min-width:30px;border-radius:20%;">--><div id="regno_error" style="color:red"></div></div>
			
			</div><br>
			<form action="parishioner_profile.php" method="POST" style="padding-left:30px;" id="parishioner_profileform" name="parishionersForm">
				<br><div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">PERSONAL INFORMATION >>></p>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				<div id="showerrors" style="color:red;">
				<?php 
				if(isset($_POST['post'])){
					if(isset($_SESSION['error']) && isset($_SESSION['formattempt'])){
						if(count($_SESSION['error']) > 0){
							unset($_SESSION['formattempt']);
							echo "<b>FORM NOT SUBMITTED</b><br>";
							echo "<b>Errors encountered:</b><br>";
							foreach($_SESSION['error'] as $error){
								echo $error."<br>";
							}
						}	
					}
				}
				?>
				</div>
				
				TITLE:<select disabled name="title" class="user_input" id="Title" style="height:22px;margin-left:10px;text-transform:uppercase"/>
					<option value="Mr">MR</option>
					<option value="Mrs">MRS</option>
					<option value="Sir">SIR</option>
					<option value="Lady">LADY</option>
					<option value="Chief">CHIEF</option>
					<option value="Lolo">LOLO</option>
					<option value="Pro.">PRO.</option>
					<option value="Dr">DR</option>
					<option value="Engr">ENGR</option>
					<option value="Barr">BARR</option>
					<option value="Comrade">COMRADE</option>
					<option value="Madam">Madam</option>
					<option value="PA">PA</option>
				</select>
				&nbsp;&nbsp;&nbsp;
				SEX:<select disabled name="sex" class="user_input" id="Sex" style="height:22px;margin-left:10px;text-transform:uppercase">
					<option value="M">M</option>
					<option value="F">F</option>
				</select>
				<br><br>
				
				SURNAME:<input disabled size="70" name="surname" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				BAPTISM NAME:<input disabled size="70" name="baptismname" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				OTHER NAMES:<input disabled size="70" name="othernames" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>

				<!--Age:<input disabled size="4" name="age" class="user_input" type="text" style="margin-left:10px;text-transform:uppercase"><br><br>-->
				<!--DATE OF BIRTH:
				<input disabled name="yearofbirth" size="4" class="user_input" type="text" placeholder="Year" style="height:22px;margin-left:10px;text-transform:uppercase">
				<input disabled name="monthofbirth" size="4" class="user_input" list="monthofbirth" placeholder="Mon" style="height:22px;text-transform:uppercase">
				<datalist id="monthofbirth">
					<option value="Jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="July"><option value="Aug"><option value="Sept"><option value="Oct"><option value="Nov"><option value="Dec">
				</datalist>
				<input disabled name="dayofbirth" size="4" class="user_input" list="dayofbirth" placeholder="Day" style="height:22px;text-transform:uppercase"><br><br>
				<datalist id="dayofbirth">
					<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
				</datalist>-->
				DATE OF BIRTH:
				<input disabled name="yearofbirth" size="4" class="user_input" type="text" placeholder="Year" style="height:22px;margin-left:10px;text-transform:uppercase">
				<select disabled name="monthofbirth" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
				</select>
				<select disabled name="dayofbirth" class="user_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
				</select><br><br>
				PLACE OF BIRTH:<input disabled size="70" name="placeofbirth" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				CURRENT ADDRRESS:<input disabled size="70" name="currentaddress" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				PERM ADDRESS:<input disabled size="70" name="permaddress" class="user_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				STATE OF ORIGIN:<input disabled size="30" name="stateoforigin" class="user_input" list="state" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				<datalist id="state">
					<option value="Abia"><option value="Adamawa"><option value="Anambra"><option value="Bauchi"><option value="Bayelsa"><option value="Benue"><option value="Borno"><option value="Crossriver"><option value="Delta"><option value="Ebonyi"><option value="Edo"><option value="Ekiti"><option value="Enugu"><option value="FCt(Abuja)"><option value="Gombe"><option value="Imo"><option value="Jigawa"><option value="Kaduna"><option value="Kano"><option value="Katsina"><option value="Kebbi"><option value="Kogi"><option value="Kwara"><option value="Lagos"><option value="Nassarawa"><option value="Niger"><option value="Ogun"><option value="Ondo"><option value="Osun"><option value="Oyo"><option value="Plateau"><option value="Rivers"><option value="Sokoto"><option value="Taraba"><option value="Yobe"><option value="Zamfara">
				</datalist>
				<div style="display:inline-block;background:lightslategray">GSM NUMBER:<br><input size="70" disabled name="gsmnumber" class="user_input" type="tel" style="height:22px;text-transform:uppercase"></div>
				<!--<div style="display:inline-block;background:lightslategray">Office Telephone:<br><input disabled name="officetelephone" class="user_input" type="tel" style="text-transform:uppercase"></div>
				<div style="display:inline-block;background:lightslategray">Home Telephone:<br><input disabled name="hometelephone" class="user_input" type="tel" style="text-transform:uppercase"></div>--><br><br>
				
				EMAIL:<input disabled name="email" class="user_input" type="email" size="70" style="height:22px;margin-left:10px;"><br><br>
			
				<!--<div style="display:inline-block;background:lightslategray">PRIMARY OCCUPATION:<br><input disabled name="primaryoccupation" size="70" class="user_input" list="primaryoccupation" style="height:22px;text-transform:uppercase"></div><div style="display:inline-block;margin-left:100px;background:lightslategray">Specialisation:<br><input disabled name="specialisationprimary" class="user_input" type="text" style="text-transform:uppercase"></div>-->
				<!--<div style="display:inline-block;background:lightslategray">Secondary Occupation:<br><input disabled name="secondaryoccupation" size="50" class="user_input" list="secondaryoccupation" style="text-transform:uppercase"></div><div style="display:inline-block;margin-left:100px;background:lightslategray">Specialisation:<br><input disabled name="specialisationsecondary" class="user_input" type="text" style="text-transform:uppercase"></div><br><br>-->
				<!--<datalist id="primaryoccupation">
					<option value="ADMINISTRATOR"><option value="ACCOUNTANT"><option value="AGRICULTURIST"><option value="AIRLINE OFFICIAL"><option value="ARCHITECT"><option value="BANKER"><option value="BEAUTY/COSMETOLOGIST"><option value="BUSINESS PERSON"><option value="CATERER"><option value="CHURCH WORKER"><option value="CIVIL SERVANT"><option value="CONSULTANT"><option value="DOCTOR"><option value="DRIVER"><option value="ECONOMIST"><option value="ENGINEER"><option value="ENTREPRENEUR"><option value="ENVIROMENTALIST"><option value="ESTATE MANAGEMENT"><option value="EVENTS PLANNER"><option value="FASHION DESIGNER"><option value="GEOLOGIST">
				</datalist>-->
				<!--
				<datalist id="secondaryoccupation">
					<option value="ADMINISTRATOR"><option value="ACCOUNTANT"><option value="AGRICULTURIST"><option value="AIRLINE OFFICIAL"><option value="ARCHITECT"><option value="BANKER"><option value="BEAUTY/COSMETOLOGIST"><option value="BUSINESS PERSON"><option value="CATERER"><option value="CHURCH WORKER"><option value="CIVIL SERVANT"><option value="CONSULTANT"><option value="DOCTOR"><option value="DRIVER"><option value="ECONOMIST"><option value="ENGINEER"><option value="ENTREPRENEUR"><option value="ENVIROMENTALIST"><option value="ESTATE MANAGEMENT"><option value="EVENTS PLANNER"><option value="FASHION DESIGNER"><option value="GEOLOGIST">
				</datalist>-->
				PRIMARY OCCUPATION:<select disabled name="primaryoccupation" class="user_input" style="height:22px;text-transform:uppercase;margin-left:10px"><option value=""></option><option value="ADMINISTRATOR">ADMINISTRATOR</option><option value="ACCOUNTANT">ACCOUNTANT</option><option value="AGRICULTURIST">AGRICULTURIST</option><option value="AIRLINE OFFICIAL">AIRLINE OFFICIAL</option><option value="ARCHITECT">ARCHITECT</option><option value="BANKER">BANKER</option><option value="BEAUTY/COSMETOLOGIST">BEAUTY/COSMETOLOGIST</option><option value="BUSINESS PERSON">BUSINESS PERSON</option><option value="CATERER">CATERER</option><option value="CHURCH WORKER">CHURCH WORKER</option><option value="CIVIL SERVANT">CIVIL SERVANT</option><option value="CONSULTANT">CONSULTANT</option><option value="DOCTOR">DOCTOR</option><option value="DRIVER">DRIVER</option><option value="ECONOMIST">ECONOMIST</option><option value="ENGINEER">ENGINEER</option><option value="ENTREPRENEUR">ENTREPRENEUR</option><option value="ENVIROMENTALIST">ENVIROMENTALIST</option><option value="ESTATE MANAGEMENT">ESTATE MANAGEMENT</option><option value="EVENTS PLANNER">EVENTS PLANNER</option><option value="FASHION DESIGNER">FASHION DESIGNER</option><option value="GEOLOGIST">GEOLOGIST</option>
				</select><br><br>
				
				<div style="width:100%;height:1px;background:black"></div>
				<p style="color:lightseagreen">MARITAL STATUS</p>
				<div style="width:100%;height:1px;background:black"></div><br>
				
				<div style="display:inline-block;">
					<input type="radio" name="maritalstatus" checked value="single" id="single"/><label for="single">SINGLE</label>
					&nbsp;&nbsp;<input type="radio" name="maritalstatus" id="married" value="married"/><label for="married">MARRIED</label>
				</div>
				<div style="display:inline-block;min-height:30px;margin-left:20px">
					SPOUSE'S BAPTISM NAME: <input disabled size="70" name="spousebaptismname" class="spouseuser_input" type="text" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
					SPOUSE'S OTHER NAMES: <input disabled size="70" name="spouseothernames" class="spouseuser_input" type="text" style="height:22px;margin-left:16px;text-transform:uppercase"><br><br>
					<!--DATE OF MARRIAGE:
					<input name="yearofmarriage" disabled size="4" class="spouseuser_input" type="text" placeholder="Year" style="height:22px;margin-left:50px;text-transform:uppercase">
					<input name="monthofmarriage" disabled size="4" class="spouseuser_input" list="monthofmarriage" placeholder="Mon" style="height:22px;text-transform:uppercase">
					<datalist id="monthofmarriage">
						<option value="Jan"><option value="Feb"><option value="Mar"><option value="Apr"><option value="May"><option value="Jun"><option value="July"><option value="Aug"><option value="Sept"><option value="Oct"><option value="Nov"><option value="Dec">
					</datalist>
					<input name="dayofmarriage" disabled size="4" class="spouseuser_input" list="dayofmarriage" placeholder="Day" style="height:22px;text-transform:uppercase"><br>
					<datalist id="dayofmarriage">
						<option value="01"><option value="02"><option value="03"><option value="04"><option value="05"><option value="06"><option value="07"><option value="08"><option value="09"><option value="10"><option value="11"><option value="12"><option value="13"><option value="14"><option value="15"><option value="16"><option value="17"><option value="18"><option value="19"><option value="20"><option value="21"><option value="22"><option value="23"><option value="24"><option value="25"><option value="26"><option value="27"><option value="28"><option value="29"><option value="30"><option value="31">
					</datalist>-->
				DATE OF MARRIAGE:<input name="yearofmarriage" disabled size="4" class="spouseuser_input" type="text" placeholder="Year" style="height:22px;margin-left:50px;text-transform:uppercase">
				<select disabled name="monthofmarriage" class="spouseuser_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="July">July</option><option value="Aug">Aug</option><option value="Sept">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option>
				</select>
				<select disabled name="dayofmarriage" class="spouseuser_input" style="height:22px;text-transform:uppercase">
					<option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
				</select><br><br>
					PLACE OF MARRIAGE:<input size="70" disabled name="placeofmarriage" class="spouseuser_input" type="text" style="height:22px;margin-left:45px;text-transform:uppercase"><br>
				</div><br><br>
				<div style="width:100%;height:1px;background:black"></div><br>
			</form>
				
				
				<!--<div style="padding-left:30px;display:flex">Number OF CHILDREN (UNDER 21):<input class="user_input" disabled id="childrennumberinput" name="numberofchildren" form="parishioner_profileform" size="3" list="numberofchildren" style="height:22px;margin-left:10px"><input id="childrennumberbutton" name="button" type="button" value="&#10095;" style="min-height:16px;min-width:30px;border-radius:20%;"></div><br><br>
				<datalist id="numberofchildren">
					<option value="1"><option value="2"><option value="3"><option value="4"><option value="5">
				</datalist>-->

				<div style="padding-left:30px;display:flex">Number OF CHILDREN (UNDER 21):<select class="user_input" disabled id="childrennumberinput" name="numberofchildren" form="parishioner_profileform" style="height:22px;margin-left:10px"><option value=""></option><option class="childrennumber" value="1">1</option><option class="childrennumber" value="2">2</option><option class="childrennumber" value="3">3</option><option class="childrennumber" value="4">4</option><option class="childrennumber" value="5">5</option></select><!--<input id="childrennumberbutton" name="button" type="button" value="&#10095;" style="min-height:16px;min-width:30px;border-radius:20%;">--></div><br><br>
				
					
				

			<form action="entryinterface.html" method="POST" style="padding-left:30px;">
				<div style="display:flex;">
				<div style="display:flex;flex-direction:column;">
					<input form="parishioner_profileform" type="text" class="childrenname_input" size="70" name="nameofchildren1"><br>
					<input form="parishioner_profileform" type="text" class="childrenname_input"  size="70" name="nameofchildren2"><br>
					<input form="parishioner_profileform"  type="text" class="childrenname_input"  size="70" name="nameofchildren3">
				</div><br><br>
				<div style="display:flex;flex-direction:column;margin-left:auto">
					<input form="parishioner_profileform"  type="text" class="childrenname_input" size="70" name="nameofchildren4"><br>
					<input form="parishioner_profileform"  type="text" class="childrenname_input"  size="70" name="nameofchildren5">
				</div>
				</div><br>
				
				YEAR OF CHURCH MEMBERSHIP:<input class="user_input" disabled name="yearofchurchmembership"  form="parishioner_profileform" size="4" type="text" placeholder="Year" style="height:22px;margin-left:10px;text-transform:uppercase"><br><br>
				<div style="width:100%;height:1px;background:black"></div><br>
			</form>
			
				
				<!--<div style="padding-left:30px;display:flex">ACTIVE SOCIETIES:<input class="user_input" disabled form="parishioner_profileform" id="societynumberinput" name="numberofsocieties" size="3" list="numberofsocieties" style="height:22px;margin-left:10px;"><input id="societynumberbutton" name="button" type="button" value="&#10095;" style="min-height:16px;min-width:30px;border-radius:20%;"></div><br><br>
				<datalist id="numberofsocieties">
					<option value="1"><option value="2"><option value="3"><option value="4"><option value="5"><option value="6">
				</datalist>-->

				<div style="padding-left:30px;display:flex">ACTIVE SOCIETIES:<select class="user_input" disabled form="parishioner_profileform" id="societynumberinput" name="numberofsocieties" style="height:22px;margin-left:10px;"><option value=""></option><option value="1" class="societynumber">1</option><option  class="societynumber" value="2">2</option><option  class="societynumber" value="3">3</option><option  class="societynumber" value="4">4</option><option  class="societynumber" value="5">5</option><option  class="societynumber" value="6">6</option></select><!--<input id="societynumberbutton" name="button" type="button" value="&#10095;" style="min-height:16px;min-width:30px;border-radius:20%;">--></div><br><br>
				
			<div style="padding-left:30px;">
				<div style="display:flex;">
				<div style="display:flex;flex-direction:column;">
					<input form="parishioner_profileform" type="text" class="societiesname_input" size="70" name="nameofsocieties1"><br>
					<input form="parishioner_profileform" type="text" class="societiesname_input"  size="70" name="nameofsocieties2"><br>
					<input form="parishioner_profileform" type="text" class="societiesname_input"  size="70" name="nameofsocieties3">
				</div><br><br>
				<div style="display:flex;flex-direction:column;margin-left:auto">
					<input form="parishioner_profileform" type="text" class="societiesname_input" size="70" name="nameofsocieties4"><br>
					<input form="parishioner_profileform" type="text" class="societiesname_input"  size="70" name="nameofsocieties5"><br>
					<input form="parishioner_profileform" type="text" class="societiesname_input"  size="70" name="nameofsocieties6">
				</div>
				</div><br><br>
				
				COMMENTS:<br><textarea disabled form="parishioner_profileform" name="comments" cols="60" rows="10" class="user_input" style="text-transform:uppercase;font-size:large;"></textarea><br><br><br>
				<div style="display:flex;width:100%;min-height:30px;background:teal;position:fixed;bottom:0;"><input form="parishioner_profileform" type="submit" value="POST" name="post" style="width:60px;height:30px"><input form="parishioner_profileform" type="reset" value="Clear all" style="width:60px;height:30px"><a href="parishioners_homepage.html"><button style="width:60px;height:30px;cursor:pointer">Home</button></a></div>
			</div>
	</div>
	<script>
	
		var titleField= document.getElementById("Title");
		var sexField= document.getElementById("Sex");
		function matchTitleWithSex(){

			if(titleField.value=="Mrs"){
				sexField.value="F";
			}else if(titleField.value=="Mr"){
				sexField.value="M";
			}
		}

		var userInput = document.getElementsByClassName("user_input");
		var regno = document.getElementById("regno");
		//var button= document.getElementById("regnobutton");
		var regno_error= document.getElementById("regno_error");
		
		regno.onkeyup = function(){
		for(i=0;i<userInput.length;i++){
			if(regno.value != "" && regno.value.match(/^\d+$/)){
				userInput[i].disabled = "";
				regno_error.innerHTML= "";
			}else{userInput[i].disabled = "disabled";regno_error.innerHTML= "Enter numbers only";}
			}
        }; 

        //var maritalstatus= document.getElementsByClassName("maritalstatus");
		var spouseuser_input= document.getElementsByClassName("spouseuser_input");
		var married= document.getElementById("married");
		var single= document.getElementById("single");
		
		married.onclick= function(){
			for(i=0;i<spouseuser_input.length;i++){
				spouseuser_input[i].disabled="";
			}	
		};
		single.onclick= function(){
			for(i=0;i<spouseuser_input.length;i++){
				spouseuser_input[i].disabled="disabled";
			}	
		};

		var societynumberinput= document.getElementById("societynumberinput");
		//var societynumberbutton= document.getElementById("societynumberbutton");
		var societynumber= document.getElementsByClassName("societynumber");
		var societiesname_input= document.getElementsByClassName("societiesname_input");
		
		if(societynumberinput.value == ""){
			for(i=0;i<societiesname_input.length;i++){
				societiesname_input[i].disabled= "disabled";
			}
		}
	
		societynumber[0].onclick= function(){
			societiesname_input[0].disabled = "";
		};
		
		societynumber[1].onclick= function(){
			societiesname_input[0].disabled= "";societiesname_input[1].disabled= "";
		};
		societynumber[2].onclick= function(){
			societiesname_input[0].disabled= "";societiesname_input[1].disabled= "";societiesname_input[2].disabled= "";
		};
		societynumber[3].onclick= function(){
			societiesname_input[0].disabled= "";societiesname_input[1].disabled= "";societiesname_input[2].disabled= "";societiesname_input[3].disabled= "";
		};
		societynumber[4].onclick= function(){
			societiesname_input[0].disabled= "";societiesname_input[1].disabled= "";societiesname_input[2].disabled= "";societiesname_input[3].disabled= "";societiesname_input[4].disabled= "";
		};
		societynumber[5].onclick= function(){
			societiesname_input[0].disabled= "";societiesname_input[1].disabled= "";societiesname_input[2].disabled= "";societiesname_input[3].disabled= "";societiesname_input[4].disabled= "";societiesname_input[5].disabled= "";
		};

		var childrennumberinput= document.getElementById("childrennumberinput");
		var childrennumberbutton= document.getElementById("childrennumberbutton");
		var childrennumber= document.getElementsByClassName("childrennumber");
		var childrenname_input= document.getElementsByClassName("childrenname_input");
		
		if(childrennumberinput.value == ""){
			for(i=0;i<childrenname_input.length;i++){
				childrenname_input[i].disabled= "disabled";
			}
		}
		childrennumber[0].onclick= function(){
			childrenname_input[0].disabled= "";
		};
		childrennumber[1].onclick= function(){
			childrenname_input[0].disabled= "";childrenname_input[1].disabled= "";
		};
		childrennumber[2].onclick= function(){
			childrenname_input[0].disabled= "";childrenname_input[1].disabled= "";childrenname_input[2].disabled= "";
		};
		childrennumber[3].onclick= function(){
			childrenname_input[0].disabled= "";childrenname_input[1].disabled= "";childrenname_input[2].disabled= "";childrenname_input[3].disabled= "";
		};
		childrennumber[4].onclick= function(){
			childrenname_input[0].disabled= "";childrenname_input[1].disabled= "";childrenname_input[2].disabled= "";childrenname_input[3].disabled= "";childrenname_input[4].disabled= "";
		};
		/*
		childrennumber[5].onclick= function(){
			childrenname_input[0].disabled= "";childrenname_input[1].disabled= "";childrenname_input[2].disabled= "";childrenname_input[3].disabled= "";childrenname_input[4].disabled= "";childrenname_input[5].disabled= "";
		}*/
		titleField.children[0].onclick= function(){matchTitleWithSex();};
		titleField.children[1].onclick= function(){matchTitleWithSex();};
	</script>
</body>
</html>