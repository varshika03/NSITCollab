<?php 

	session_start();
	include("connect.php");

	// Get the user currently using and the profile they are currently viewing
	$userProfile = $_SESSION['latestProfileID'];
	$currentUser = $_SESSION['loggedInUser'];

	// Remove entry where the current user is viewing the person they wish to unfollow
	$sql = "DELETE FROM users_following WHERE followingID = '$currentUser' AND followerID = '$userProfile'";
	$result = mysqli_query($connection, $sql);

	// Refresh age
	echo("<meta http-equiv='refresh' content='0'/>");
	
?>