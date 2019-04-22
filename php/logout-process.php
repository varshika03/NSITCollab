<?php 
	session_start();

	// Set session variables to blank
	$_SESSION['isLoggedIn'] = false;
	$_SESSION['loggedInUser'] = "";
	$_SESSION['loggedInUsername'] = "";

	echo("<meta http-equiv='refresh' content='0; url=login.php'/>");
?>