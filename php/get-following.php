<?php 

	include("connect.php");
	
	// Get ID of porfile currently on
	$userId = $_SESSION['latestProfileID'];

	// Select all rows where users are following ID
	$sql = "SELECT * FROM users_following WHERE followingID = '$userId'";
	$result = mysqli_query($connection, $sql);
	
	
	if ($result->num_rows > 0) {
		echo "<div class='collection followers'>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$following = $row["followerID"];
			$sql = "SELECT type FROM users_master WHERE id = '$following'";
			$result = mysqli_query($connection, $sql);
			while($row = $result->fetch_assoc()) {
				$type = $row["type"];

				switch($type) {
					case "student":
						$sqlSort = "SELECT username, name FROM users_student WHERE id = '" . $following . "'";
						break;
					case "professor":
						$sqlSort = "SELECT username, name FROM users_professor WHERE id = '" . $following . "'";
						break;
					case "employer":
						$sqlSort = "SELECT username, company_name FROM users_employer WHERE id = '" . $following . "'";
						break;
					case "alumni":
						$sqlSort = "SELECT username, name FROM users_alumni WHERE id = '" . $following . "'";
						break;
				}
				$resultTwo = mysqli_query($connection, $sqlSort);

				while($rowTwo = $resultTwo->fetch_assoc()) {
					echo "<a href='profile.php?user=" . $rowTwo["username"] . "' class='collection-item'>" . $rowTwo["name"] . "</a>";
				}
				
			}
		}
		echo "</div>";
	} else {
		echo "0 followers";
	}
?>