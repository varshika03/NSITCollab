<?php 
	include("header.php"); 
	include("php/connect.php");
	//fetch email query to display it
	// Find type of user
	$currentUserID = $_SESSION['loggedInUser'];
	$fetch_email = "SELECT email FROM users_master WHERE id = '$currentUserID'";
	$result = mysqli_query($connection, $fetch_email);

	while ($row = mysqli_fetch_array($result)) {
		$_SESSION['email'] = $row['email'];
	}

?>
<div class="container">
	<div class="row">
		<div class="col s12">
			<h1>Account Settings: <?php
				echo $_SESSION['loggedInUsername'];
				?></h1>
			
			<!-- CHANGE PASSWORD -->
			<p id="change_password_anchor" style="color: blue;">Change Password</p>

			<!-- Enter your current password here to continue in changing it -->
			<!-- Hidden until validated -->
			<div class="change_current_password hide">
				<p id="current_password_output">Enter your current password to proceed</p>
				<input id='current_password_field' type='password' name='current_password_field'>
				<label for='current_password_field'>Password</label>
				<br>
				<input type="button" value="Proceed" id="current_password_field_confirm" class="btn">
			</div>
			<!-- Change your password; type in new and confirm -->
			<div class="change_password hide">
				<div id="change_password_output">Enter your new password and confirm</div>
				<input id='new_password_field' type='password' name='new_password_field'>
				<label for='new_password_field'>New Password</label>
				
				<input id='confirm_new_password_field' type='password' name='confirm_new_password_field'>
				<label for='confirm_new_password_field'>Confirm New Password</label>
				<br>
				<input type="button" value="Change Password" id="password_change_confirm" class="btn">
				
			</div>
			
			<!-- CHANGE EMAIL Doesn't work for some reason?-->
				<div class="email_notification">Email notification</div>
				<input type="text" id="email_change" value="<?php
						echo $_SESSION['email'];?>">
				<label for="email_change">Email</label>
				<br>
				<input type="button" id="email_change_confirm" value="Change" class="btn">

		</div>
		
		<div class="col s12" id="result">
			
		</div>
	</div>
</div>

<?php

	$sql = "SELECT type FROM users_master WHERE id = '$currentUserID'";

	$result = mysqli_query($connection, $sql);

	// Query the table that is their type where the appropriate info is held
	while ($row = mysqli_fetch_array($result)) {
		$type = $row["type"];

		switch ($type) {
			case "student":
				$sqlSort = "SELECT * FROM users_student WHERE id = '$currentUserID'";
				break;
			case "professor":
				$sqlSort = "SELECT * FROM users_professor WHERE id = '$currentUserID'";
				break;
			case "alumni":
				$sqlSort = "SELECT * FROM users_alumni WHERE id = '$currentUserID'";
				break;
			case "employer":
				$sqlSort = "SELECT * FROM users_employer WHERE id = '$currentUserID'";
				break;
		}

		$update = mysqli_query($connection, $sqlSort);

		// Accessing about as a variable. This will be expanded to have more later, but for now, only about is being saved
		while ($rowSort = mysqli_fetch_array($update)) {
			$about = $rowSort["bio"];
		}
	}
?>
<script>
	// Display the current about text in the textarea
	var aboutText = "<?php 
		echo $about 
	?>";
	$('#about-edit').val(aboutText);
</script>
<?php include("footer.php"); ?>