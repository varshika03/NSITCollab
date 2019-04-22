<?php include("header.php"); ?>
<div class="container profile">
<?php
	include("php/connect.php");

$user = $_SESSION['loggedInUser'];
$sql = "SELECT type FROM users_master WHERE id = '$user'";
$result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_array($result)) {
		
		// Get proper table for profile data
		$type = "users_" . $row["type"];
		$sqlSort = "SELECT * FROM " . $type . " WHERE id = '$user'";
		$update = mysqli_query($connection, $sqlSort);

		while ($row = mysqli_fetch_array($update)) {
			// Get necessary profile info from database
			$about = $row["bio"];
			$currentUser= $row["name"]
?>

			<div class="row main">
				<div class="col s3">
					<?php
					if (empty($row['picture'])) {
						//provide default img if img column is blank (user hasn't uploaded a pic)
						echo "<img src='img/default.png' class='prof_pic' alt='default'>";
					} else {
						echo "<img src='img/".$row['picture']."' class='prof_pic' alt='default'>";
					}
					?>
				</div>
				<div class="col s1"></div>
				<div class="col s8">
					<h1><?php echo $currentUser; ?></h1>
					<p class="about"><?php echo $about; ?></p>	
				</div>

			</div>
		








			<h2> My posts </h2>
			<?php

			$sql = "SELECT * FROM post_master WHERE user_id = '$user'";
$result = mysqli_query($connection, $sql);
if($result->num_rows > 0){
while ($row = $result->fetch_assoc()) {
	$post_id = $row['id'];

	echo "<div class='card'>
					<div class='card-content part-width'>
	            <div class='card-content-img'>
						<img height='350mm' src='img/" . $row["picture"] . "'>
						</div>
						<div class='card-title'>
							<p>" . $row["comment"] . "</p>
						</div>
						<div class='clear'></div>
					</div>
					<form enctype='multipart/form-data'  action='php/delete_post.php' method='POST' class='contact-form' id='delete-post'>
						<input type='hidden' name='post_id' value='" . $post_id ."'>
					<input type='submit' name='delete-post' class='btn btn-primary right' style='background-color:red;'   value='Delete-post'>
								</form>
					</div>";
		
		}
	} else{
		echo "No posts";
	}

		?>
	







	<h2>My openings</h2>
	<?php
        $sql = "SELECT * FROM openings_master WHERE user_id = '$user'";
$result = mysqli_query($connection, $sql);
if($result->num_rows > 0){
while ($row = $result->fetch_assoc()) {

echo "<div class='card'>
<div class='card-content part-width'>
<div class='card-content-img'>
						<img src='img/" . $row["picture"] . "'>
						</div>
						<div class='card-content-inner'>
							<p>" . $row["description"] . "</p>
						</div>
						<div class='card-content-inner'>
							<p><b><u>Eligibility: </u></b>" . $row["eligibility"] . "</p>
						</div>
						
						";

	echo "<div class='card-content-inner'>
	<div class='card-title' style='background-color:black;'>
	<b>APPLICANTS</b>
	</div>
	</div>
	<ol>";
	$opening_id=$row["id"];
	$sql2 = "SELECT * FROM applications WHERE opening_id = '$opening_id'";
$result2 = mysqli_query($connection, $sql2);
if($result2->num_rows > 0){
while ($row2 = $result2->fetch_assoc()) {

$applicant_id=$row2["user_id"];
$sql3="SELECT type from users_master where id='$applicant_id'";
$result3= mysqli_query($connection, $sql3);
while ($row3 = $result3->fetch_assoc()){
$type = $row3["type"];
}

			switch($type) {
				case "student":
					$sqlSort = "SELECT username FROM users_student WHERE id = '" . $applicant_id . "'";
					break;
				case "professor":
					$sqlSort = "SELECT username FROM users_professor WHERE id = '" . $applicant_id . "'";
					break;
				case "employer":
					$sqlSort = "SELECT username FROM users_employer WHERE id = '" . $applicant_id . "'";
					break;
				case "alumni":
					$sqlSort = "SELECT username FROM users_alumni WHERE id = '" . $applicant_id . "'";
					break;
			}

$result4= mysqli_query($connection, $sqlSort);
while ($row4 = $result4->fetch_assoc()){

 echo "<div class='card-content-inner'><li style='padding_left='400mm';'> <a href='profile.php?user=".$row4["username"]."'>" . $row4["username"] . "</a> </li></div>
 ";
}	
}
} else
{
	echo " No applicants";
}
echo"</ol><div class='clear'></div></div>
<form enctype='multipart/form-data'  action='php/delete-opening.php' method='POST' class='contact-form' id='delete-opening'>
						<input type='hidden' name='opening_id' value='" . $opening_id ."'>
					<input type='submit' name='delete-opening' class='btn btn-primary right' style='background-color:red;'   value='Delete-Opening'>
								</form>
								</div>";

}
} else {
	echo "No openings";
}

			  ?>









			
			<h2> My applications </h2>
			<?php

			$sql = "SELECT * FROM applications WHERE user_id = '$user'";
         $result = mysqli_query($connection, $sql);
         if($result->num_rows > 0){
while ($row = $result->fetch_assoc()) {
	$opening_id=$row["opening_id"];
    $sql2 = "SELECT * FROM openings_master WHERE id = '$opening_id'";
    $result2 = mysqli_query($connection, $sql2);
	while($row2 = $result2->fetch_assoc()){

			$type = $row2["type"];
			$userId = $row2["user_id"];

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
								<p>Posted: " . $row2["time_posted"] . "</p>
							</li>
						</ul>
						<div class='card-content-img'>";
						echo "<img src='img/" . $row2["picture"] . "'>
						</div>
						<div class='card-content-inner'>
							<p>" . $row2["description"] . "</p>
						</div></br>
						<div class='card-content-inner'>
							<p><b><u>Eligibility: </u></b>" . $row2["eligibility"] . "</p>
						</div>
						
						<div class='clear'></div>

					</div>
					
				</div>";
		}
		
		}
	} else{
		echo "No current applications";
	}
		?>
			<?php 
	}}
   
?>
</div>
<?php include("footer.php"); ?>