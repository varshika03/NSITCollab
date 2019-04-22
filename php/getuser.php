<?php

include("connect.php");
$q = $_GET['q'];

$sql = "SELECT * FROM users_master
	WHERE id LIKE '%$q%'
	OR username LIKE '%$q%'
	OR email LIKE '%$q%'
	OR type LIKE '%$q%'";
$result = mysqli_query($connection, $sql);

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


mysqli_close($connection);
?>
