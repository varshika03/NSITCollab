<?php 

	session_start();
	include('connect.php');

	$opening= $_POST['opening_id']; 
	$user = $_SESSION['loggedInUser'];

	
	$sql = "DELETE FROM openings_master where id='$opening'";
	$result = mysqli_query($connection, $sql);
	$sql2 = "DELETE FROM applications where opening_id='$opening'";
	$result2 = mysqli_query($connection, $sql2);
	echo "Opening Deleted";		
	echo("<meta http-equiv='refresh' content='1; url=../dashboard.php'/>");
		
?>