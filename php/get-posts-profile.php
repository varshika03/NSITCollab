<?php 

	include("connect.php");
	$userId = $_SESSION['latestProfileID'];

	// Retrieve all users from database
	$sql = "SELECT * FROM post_master WHERE user_id = '" . $userId . "'";
	$result = mysqli_query($connection, $sql);
	
	// Generates table that gives list of all users and a link to their profile
	if ($result->num_rows > 0) {
		echo "<div class='col s12'>
						<div class='row'>";

		// output data of each row
		while($row = $result->fetch_assoc()) {
			$type = $row["type"];

			switch($type) {
				case "student":
					$sqlSort = "SELECT username, name, picture FROM users_student WHERE id = '" . $userId . "'";
					break;
				case "professor":
					$sqlSort = "SELECT username, name, picture FROM users_professor WHERE id = '" . $userId . "'";
					break;
				case "employer":
					$sqlSort = "SELECT username, company_name, picture FROM users_employer WHERE id = '" . $userId . "'";
					break;
				case "alumni":
					$sqlSort = "SELECT username,name, picture FROM users_alumni WHERE id = '" . $userId . "'";
					break;
			}
			$resultTwo = mysqli_query($connection, $sqlSort);

			while($rowTwo = $resultTwo->fetch_assoc()) {
				$name = $rowTwo["name"];
				$username = $rowTwo["username"];
				$picture = $rowTwo["picture"];

				if (empty($rowTwo['picture'])) {
					$picture = "img/default.png";
				} else {
					$picture = "img/" . $rowTwo["picture"];
				}
			}

			echo "<div class='col s12'>
				<div class='card'>
					<div class='card-content part-width'>
						<ul class='collection'>
							<li class='collection-item avatar'>
								<img src='" . $picture . "' class='circle'>
								<span class='title'>" . $name . "</span>
								<p>Posted: " . $row["time_posted"] . "</p>
							</li>
						</ul>
						<div class='card-content-img'>";
						echo "<img src='img/" . $row["picture"] . "'>
						</div>
						<div class='card-content-inner'>
							<p>" . $row["comment"] . "</p>
						</div>
						<div class='clear'></div>
					</div>
				</div>
			</div>";
		}
		echo "</div></div>";
	} else {
		echo "No posts yet.";
	}
?>