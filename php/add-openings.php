<?php 

	session_start();
	include('connect.php');
	$target = "../img/"; 
	$target = $target . basename($_FILES['photo']['name']); 

	$description= $_POST['desc']; 
	$eligibility= $_POST['eligibility']; 
	$user = $_SESSION['loggedInUser'];

	$sqlTwo = "SELECT type FROM users_master WHERE id = '$user'";
	$result = mysqli_query($connection, $sqlTwo);
	while ($row = $result->fetch_assoc()) {
	    $type = $row['type'];
	}
	$date = date('Y-m-d H:i:s');

	$filename = $_FILES["photo"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$allowed_file_types = array('.jpg','.jpeg','.png','.gif', '.JPG', '.JPEG', '.PNG');	

	if (in_array($file_ext,$allowed_file_types))
	{	
		// Rename file
		$newfilename = $user . "-" . md5($file_basename) . $file_ext;
		if (file_exists("../img/" . $newfilename))
		{
			// file already exists error
			echo "You have already uploaded this file.";
		}
		else
		{		
			move_uploaded_file($_FILES["photo"]["tmp_name"], "../img/" . $newfilename);
			$sql = "INSERT INTO openings_master (user_id, time_posted, type, picture, description, eligibility) VALUES('$user','$date', '$type', '$newfilename', '$description','$eligibility')";
			$result = mysqli_query($connection, $sql);
			echo "File uploaded successfully.";		
			echo("<meta http-equiv='refresh' content='1; url=../feed.php'/>");
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
	} 
	else
	{
		// file type error
		echo "Only these file types are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["photo"]["tmp_name"]);
	}
?>