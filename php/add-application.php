<?php 

	session_start();
	include('connect.php');

	$opening= $_POST['opening_id']; 
	$user = $_SESSION['loggedInUser'];

	
	$sql = "INSERT INTO applications (user_id, opening_id) VALUES('$user','$opening')";
	$result = mysqli_query($connection, $sql);
	echo "Application Submitted";		
	echo("<meta http-equiv='refresh' content='1; url=../feed.php'/>");
		
?>