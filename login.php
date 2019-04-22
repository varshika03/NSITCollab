<?php include("header.php"); ?>
	<div class="container" >
		<div class="row">
			<div class="col s12">
				<?php
					if ($_SESSION['isLoggedIn'] == true) {
						// If user that is logged in gets to this page by mistake, redirect them to home
						echo("<meta http-equiv='refresh' content='0; url=index.php'/>");
					} else {
						?>
						<div class='row'>
							<div class='col m6'>
								<h3>Login</h3>
								<form action='' method='POST' class='contact-form' id='login'>
									<div class='input-field col s12'>
										<input id='username' type='text' name='username'>
										<label for='username'>Username</label>
									</div>
									<div class='input-field col s12'>
										<input id='password' type='password' name='password'>
										<label for='password'>Password</label>
									</div>
									<input type='submit' name='login' class='btn btn-primary' value='Login'>
								</form>
							</div>
							<div class='col m6'>
								<h3>Register</h3>
								<form action='' method='POST' class='contact-form' id='register'>
									<div class='row'>
										<div class='input-field col s6'>
											<input id='name' type='text' name='name' required>
											<label for='name'>Full Name/Company Name</label>
										</div>
										<div class='input-field col s6'>
											<input id='email' type='email' name='email' required>
											<label for='email'>Email</label>
										</div>
										<div class='input-field col s6'>
											<input id='username' type='text' name='username' required>
											<label for='username'>Username</label>
										</div>
										<div class='input-field col s6'>
											<input id='password' type='password' name='password' required>
											<label for='password'>Password</label>
										</div>
									</div>
									<div class='row'>
										<div class='input-field col s12'>
											<select name='userType' required>
												<option value='selection' disabled selected>Make Selection</option>
												<option value='student'>NSIT Student</option>
												<option value='professor'>NSIT Professor</option>
												<option value='alumni'>NSIT Alumni</option>
											</select>
											<label>User Type</label>
										</div>
									</div>

									<input type='submit' name='register' class='btn btn-primary' value='Register'>
								</form>
							</div>
						</div>
						<?php
					}
				?>
			</div>
			
			<div class="col s12" id="result">
			</div>
		</div>
	</div>
<?php include("footer.php"); ?>