<?php 
	session_start();
	include("connect.php");

	// Get necessary data from form
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$type = $_POST['userType'];
	
	// Store password with sha1
	$password = sha1($password);

	// Double check to see if username already exists
	$sql = "SELECT 1 FROM users_master WHERE username = '$username' OR email = '$email'";
	$result = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($result);

	if( $count >= 1 ) {
		echo "Username or email already exists.";
	} else {

		$sql = "INSERT INTO users_master (username, email, password, type) VALUES('$username','$email', '$password', '$type')";
		$result = mysqli_query($connection, $sql);

		// Retrieve user ID from table
		$sqlTwo = "SELECT id FROM users_master WHERE username = '$username'";
		$resultTwo = mysqli_query($connection, $sqlTwo);

		while($row = $resultTwo->fetch_assoc()) {
			// Set session variables for use in other locations
			$userId = $row["id"];
			$_SESSION['loggedInUser'] = $userId;
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['loggedInUsername'] = $username;

			// Uses the user type specified in the form to put user in appropriate table
			switch ($type) {
				case "student":
					$sqlSort = "INSERT INTO users_student 
						(id, username, name, picture, school_year, major, field_interests, bio, achievements, facebook, linkedin, behance, codepen, github, snapchat, instagram, tumblr, twitter, skills, software, languages, organizations, portfolio_link, resume_upload) 
						VALUES('$userId', '$username', '$name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
					break;

				case "professor":
					$sqlSort = "INSERT INTO users_professor 
						(id, username, name, picture, career_field, committee, research, bio, achievements, linkedin, facebook, behance, codepen, github, snapchat, instagram, tumblr, twitter, email) 
						VALUES('$userId', '$username', '$name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
					break;

				case "alumni":
					$sqlSort = "INSERT INTO users_alumni 
						(id, username, name, picture, graduate_year, major, field_interests, bio, achievements, facebook, linkedin, behance, codepen, github, snapchat, instagram, tumblr, twitter, skills, software, languages, portfolio_link, resume_upload) 
						VALUES('$userId','$username', '$name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
					break;
					
				case "employer":
					$sqlSort = "INSERT INTO users_employer 
						(id, username, company_name, picture, company_overview, company_address, requirements, achievements, facebook, linkedin, website, career_link) 
						VALUES('$userId','$username', '$name', '', '', '', '', '', '', '', '', '')";
					break;
			}
			
			$result = mysqli_query($connection, $sqlSort);
			echo("<meta http-equiv='refresh' content='1; url=profile.php?user=" . $username . "'/>");
			echo "Account created. Redirecting...";
		}

		
	}
?>