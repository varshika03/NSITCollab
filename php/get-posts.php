<?php 

	include("connect.php");
	
	// Retrieve all users from database
	$sql = "SELECT * FROM post_master";
	$result = mysqli_query($connection, $sql);

	$sql_openings = "SELECT * FROM openings_master";
	$result_openings = mysqli_query($connection, $sql_openings);
	
	// Generates table that gives list of all users and a link to their profile
	while($result->num_rows > 0 or $result_openings->num_rows > 0) {
        $flag=0;
		// output data of each row
		if($row = $result->fetch_assoc()){
			$flag=1;
			$type = $row["type"];
			$userId = $row["user_id"];

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
					$sqlSort = "SELECT username, name, picture FROM users_alumni WHERE id = '" . $userId . "'";
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

			echo "<div class='card'>
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
				</div>";
		}

if($row = $result_openings->fetch_assoc()){
	$opening_id = $row["id"];
	$flag=1;
			$type = $row["type"];
			$userId = $row["user_id"];

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
					$sqlSort = "SELECT username, name, picture FROM users_alumni WHERE id = '" . $userId . "'";
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

			echo "<div class='card'>
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
							<p>" . $row["description"] . "</p>
						</div></br>
						<div class='card-content-inner'>
							<p><b><u>Eligibility: </u></b>" . $row["eligibility"] . "</p>
						</div>
						<form enctype='multipart/form-data'  action='php/add-application.php' method='POST' class='contact-form' id='add-application'>
						<input type='hidden' name='opening_id' value='" . $opening_id ."'>
					<input type='submit' name='add-application' class='btn btn-primary right' value='Apply'>
								</form>
						<div class='clear'></div>

					</div>
					
				</div>";
		}

if($flag ==0)
{
	break;
}

	} 




?>