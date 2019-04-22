<?php include("header.php"); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
			<h1>Edit Profile</h1>
			<form class="col s12" enctype="multipart/form-data" action='php/edit-profile.php' method='POST' id='edit'>
				<div class="row">
					<div class="input-field col s12">
						<textarea id="about-edit" name="about-edit" class="materialize-textarea"></textarea>
						<label for="about-edit">About</label>
					</div>
					<div class='input-field col s12'>Upload Profile Picture: <input type="file" name="file" id="file">
					</div>
				<div class='input-field col s12'>Upload Resume: <input type="file" name="resume" id="resume">
					</div>
					<input type='submit' name='edit' class='btn btn-primary' value='Edit'>
				</div>
			</form>
		</div>
		
		<div class="col s12" id="result">
			
		</div>
	</div>
</div>

<?php
	include("php/connect.php");

	// Find type of user
	$currentUserID = $_SESSION['loggedInUser'];
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