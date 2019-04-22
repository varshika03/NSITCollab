<?php 

	session_start();
	include("connect.php");
	
	// Get user and pass from form
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Store as secure key
	$password = sha1($password);

	// Check to see if user and pass exists
	$sql = "SELECT 1 FROM users_master WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($result);

	// Get user ID from table
	$sqlTwo = "SELECT id FROM users_master WHERE username = '$username'";
	$resultTwo = mysqli_query($connection, $sqlTwo);

	if( $count == 1 ) {
		
		// Store necessary session IDs.
		$_SESSION['isLoggedIn'] = true;
		$_SESSION['loggedInUsername'] = $username;
		
		while($row = $resultTwo->fetch_assoc()) {
			$_SESSION['loggedInUser'] = $row["id"];
		}

		// Redirect to the user's profile
		echo "Login is successful. Redirecting to profile..";
		echo("<meta http-equiv='refresh' content='1; url=profile.php?user=" . $username . "'/>");
	} else {
		echo "Username or password is invalid.";
	}
?>