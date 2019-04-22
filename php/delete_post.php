<?php 

	session_start();
	include('connect.php');

	$post_id= $_POST['post_id']; 
	$user = $_SESSION['loggedInUser'];

	
	$sql = "DELETE FROM post_master where id='$post_id'";
	$result = mysqli_query($connection, $sql);
	echo "Post Deleted";		
	echo("<meta http-equiv='refresh' content='1; url=../dashboard.php'/>");
		
?>