<?php 

	include("connect.php");
	
	// Retrieve all users from database
	$sql = "SELECT username, type FROM users_master";
	$result = mysqli_query($connection, $sql);
	
	// Generates table that gives list of all users and a link to their profile
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$type = $row['type'];
			$username = $row["username"];

			switch($type) {
				case "student":
					$sqlSort = "SELECT name, picture FROM users_student WHERE username = '" . $username . "'";
					break;
				case "professor":
					$sqlSort = "SELECT name, picture FROM users_professor WHERE username = '" . $username . "'";
					break;
				case "employer":
					$sqlSort = "SELECT company_name, picture FROM users_employer WHERE username = '" . $username . "'";
					break;
				case "alumni":
					$sqlSort = "SELECT name, picture FROM users_alumni WHERE username = '" . $username . "'";
					break;
			}

			$resultTwo = mysqli_query($connection, $sqlSort);

			while($rowTwo = $resultTwo->fetch_assoc()) {
				if ($type == "employer") {
					$name = $rowTwo["company_name"];
					$picture = $rowTwo["picture"];
				} else {
					$name = $rowTwo["name"];
					$picture = $rowTwo["picture"];
				}
				
				if (empty($rowTwo['picture'])) {
					$picture = "img/default.png";
				} else {
					$picture = "img/" . $rowTwo["picture"];
				}
			}
			

			echo "<div class='col s6 m4 l4'>
					<div class='card member'>
						<a href='profile.php?user=" . $username . "'>
						<div class='card-image' style='background-image:url(" . $picture . ")'>
						</div>
						<div class='card-content'>
							<span class='card-title'>" . $name . "</span>
							<p class='subtitle'>" . $type . "</p>
						</div>
						</a>
					</div>
				</div>";
		}
	} else {
		echo "0 results";
	}
?>