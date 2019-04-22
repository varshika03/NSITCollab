<?php 

	session_start();
	include("connect.php");

	// Get session variables to find who's profile you are currently on and the user currently logged on
	$userProfile = $_SESSION['latestProfileID'];
	$currentUser = $_SESSION['loggedInUser'];

	// This simply double checks to see if the user is already following. While the user should never be given the option to double follow, this is a precaution.
	$sql = "SELECT 1 FROM users_following WHERE followingID = '$currentUser' AND followerID = '$userProfile'";
	$result = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($result);

	if( $count != 1 ) {
		// Add entry into users_following with the user IDs of the users
		$sql = "INSERT INTO users_following (followingID, followerID) VALUES('$currentUser','$userProfile')";
		$result = mysqli_query($connection, $sql);

		// Refresh the page
		echo("<meta http-equiv='refresh' content='0'/>");
	}
	
?>