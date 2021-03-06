<!DOCTYPE html>

<html>

<head>
<link rel="stylesheet" type="text/css" href="css/beautify.css"/>

<title>O.C.A.G</title>

</head>
<body>
<div id="wrapper">

<?php 
require('functions/checkidentity.php');
if(!(isloggedin("admin")==true))
{
	header('Location: login.php');
}
else
{
	include("include/head.php");
	echo "
	<div id='content' style='margin-top: 20px'>
		<h3>Register students via csv</h3>
		<form method='post' enctype='multipart/form-data' action='./functions/makestudent.php'>
		<p style='margin-top: 20px'><ul>
		<li style='margin-top: 20px'>Upload the CSV file containing the data about students.<br></li>
		<li style='margin-top: 5px'>The rows should adhere strictly to the following format:<br></li>
		<li style='margin-top: 5px'>Roll no, Full name, Date of birth, Email address, College, Branch[,group1,group2,...]<br></li>
		<ul list-style-type: 'square'>
		<li style='margin-top: 5px'>All fields should be in different columns in CSV file.<br>
		<li style='margin-top: 5px'>Roll no,Full name and Email are compulsary fields.<br>
		<li style='margin-top: 5px'>[,group1,group2] is optional list of groups that the student belongs to. These groups should be created in the database prior to uploading the file.<br>
		<li style='margin-top: 5px'>Initially the password of the newly created account is the Roll no in upper case.<br>
		<br>
		</p>
		</ul>
		</ul>
			<input type='file' name='student_file' />
			<input type='submit' value='Add Students' class='bbutton' style='margin-top: 20px' />
		</form>
	";
	if(isset($_GET['result']))
		echo $_GET['result'];
	echo 
	"
	</div>
	";
	include("include/side.php"); 
	include("include/bottom.php"); 
}
?>
</div>

</body>

</html>
