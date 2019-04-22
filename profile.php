<?php include("header.php"); ?>
<div class="container profile">
<?php
	include("php/connect.php");

	// Get current user from URL and create it as a session so that is usable in other files.
	$currentUser = $_GET["user"];
	$_SESSION['latestProfileUsername'] = $currentUser;

	$sql = "SELECT id FROM users_master WHERE username = '$currentUser'";
	$result = mysqli_query($connection, $sql);	

	while($row = $result->fetch_assoc()) {
		$_SESSION['latestProfileID'] = $row["id"];
	}

	if ($_SESSION['isLoggedIn'] == true) {
		// Variable for finding if this is the profile of currently logged on user
		if ($currentUser == $_SESSION['loggedInUsername']) {
			$selfProfile = true;
		} else {
			$selfProfile = false;
		}
	} else {
		$selfProfile = false;
	}
	

	// Get user type
	$sql = "SELECT * FROM users_master WHERE username = '$currentUser'";
	$result = mysqli_query($connection, $sql);

	while ($row = mysqli_fetch_array($result)) {
		
		// Get proper table for profile data
		$type = "users_" . $row["type"];
		$sqlSort = "SELECT * FROM " . $type . " WHERE username = '$currentUser'";
		$email = $row["email"];
		$update = mysqli_query($connection, $sqlSort);
		

		while ($row = mysqli_fetch_array($update)) {
			// Get necessary profile info from database
			$about = $row["bio"];
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
					if(!empty($row["resume_upload"])){
					echo "<embed src='resume/".$row['resume_upload']."' width='800px' height='800px' />";
				}
					?>
				</div>
				<div class="col s1"></div>
				<div class="col s8">
					<h1>Profile: <?php echo $currentUser; ?></h1>
					<p class="about"><?php echo $about; ?></p>
					<p><b>Email_ID: </b> <?php echo $email; ?></p>

					<?php if ($selfProfile == true) { ?>
						<a href='edit.php' class='btn'>Edit Profile</a>
						<a href='accountSetting.php' class='btn'>Account Setting</a>
					<?php } ?>

					<?php
						if ($selfProfile != true) {
							if ($_SESSION['isLoggedIn'] == true) {
								$userProfile = $_SESSION['latestProfileID'];
								$browsingUser = $_SESSION['loggedInUser'];
								$sql = "SELECT 1 FROM users_following WHERE followingID = '$browsingUser' AND followerID = '$userProfile'";
								$result = mysqli_query($connection, $sql);
								$count = mysqli_num_rows($result);

								if( $count != 1 ) {
									echo "<form action='' method='POST' id='follow'>
											<input type='submit' name='follow' class='btn' value='Follow'>
										</form>";
								} else {
									echo "<form action='' method='POST' id='unfollow'>
											<input type='submit' name='unfollow' class='btn' value='Unfollow'>
										</form>";
								}
							}
						}
					?>
				</div>
			</div>
			<div class="row">
				<div class="col m3">
					<h4>Followers</h3>
						<?php include("php/get-followers.php"); ?>
					<h4>Following</h4>
						<?php include("php/get-following.php"); ?>
				</div>
				<div class="col m9">
					<?php include("php/get-posts-profile.php"); ?>
				</div>
			</div>
			
			<?php
    }
  }
?>
</div>
<?php include("footer.php"); ?>
