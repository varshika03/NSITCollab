<?php 
	session_start();
	include("connect.php");

	// Get input from textarea form
	$text = addslashes($_POST['about-edit']);
	$currentUser = $_SESSION['loggedInUsername'];
	$pic = $_FILES['file']['name']; 
	$temp_name  = $_FILES['file']['tmp_name'];
	$path = "img/" . $pic;

	$resume = $_FILES['resume']['name']; 
	$temp_resume_name  = $_FILES['resume']['tmp_name'];
	$path = "img/" . $resume;

	// Find type to get proper database
	$sql = "SELECT type FROM users_master WHERE username = '$currentUser'";
	$result = mysqli_query($connection, $sql) or die("MySQL error: " . mysqli_error($connection));

	while ($row = mysqli_fetch_array($result)) {
		// Get name of database table for user group
		$type = $row["type"];
		$type = "users_" . $row["type"];

		if (isset($pic)){
        	if(!empty($pic)){      
	            $location = '../img/';      
	            if(move_uploaded_file($temp_name, $location.$pic)){
	                $sqlSort = "UPDATE " . $type . " SET bio = '$text', picture = '$pic' WHERE username = '$currentUser'";
	            } else {
	            	echo "Picture was too large.";
	            	$sqlSort = "UPDATE " . $type . " SET bio = '$text' WHERE username = '$currentUser'";
	            }

	            $result = mysqli_query($connection, $sqlSort) or die("MySQL error: " . mysqli_error($connection));
	        }       
	    }

	    if (isset($resume)){
        	if(!empty($resume)){      
	            $location = '../resume/';      
	            if(move_uploaded_file($temp_resume_name, $location.$resume)){
	                $sqlSort = "UPDATE " . $type . " SET resume_upload = '$resume' WHERE username = '$currentUser'";
	            } else {
	            	echo "Picture was too large.";
	            	$sqlSort = "";
	            }

	            $result = mysqli_query($connection, $sqlSort) or die("MySQL error: " . mysqli_error($connection));
	        }       
	    }

	    $sqlSort2 = "UPDATE " . $type . " SET bio = '$text' WHERE username = '$currentUser'";
	    $result = mysqli_query($connection, $sqlSort2) or die("MySQL error: " . mysqli_error($connection));

		echo "Profile updated. Redirecting...";
		echo("<meta http-equiv='refresh' content='1; url=../profile.php?user=" . $currentUser . "'/>");
    }
?>