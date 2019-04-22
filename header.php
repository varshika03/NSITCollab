<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Compiled and minified CSS -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="css/materialize.css">
		<link rel="stylesheet" href="css/style.css">


		<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

		<title>NSIT Collab</title>
	</head>
	<?php
		session_start();

		// If this is users first time to site, this sets logged in to false rather than null.

		if (!isset($_SESSION['isLoggedIn'])) {
			$_SESSION['isLoggedIn'] = false;

		}
	?>
	<body id="content">
		<div class="navbar-fixed">
			<nav class="" role="navigation" id="navigation">
				<div class="nav-wrapper container">
					<a href="index.php" class="brand-logo"><img src="img/logo.png"></a>
					<ul class="right hide-on-med-and-down">
					
					<?php 
						// Different navigation is being displayed whether or not user is logged in

						if ($_SESSION['isLoggedIn'] == true) {
							echo "
							<li><a href='feed.php'>Feed</a></li>
						   <li><a href='members.php'>Members</a></li>
						   <li><a href='dashboard.php?user=" . $_SESSION['loggedInUsername'] . "'>My Dashboard</a></li>
								<li><a href='profile.php?user=" . $_SESSION['loggedInUsername'] . "'>My Profile</a></li>
								<li><form action='' method='POST' id='logout'>
									<input type='submit' name='login' class='btn btn-secondary' value='Logout'>
								</form></li>
							";
						} else {

							echo "
						<li><a href='login.php'>Login/Register</a></li>";
						}
					?>
					</ul>
					<ul id="nav-mobile" class="sidenav">
						<li><a href='feed.php'>Feed</a></li>
						<li><a href='members.php'>Members</a></li>
						<?php 
						// Different navigation is being displayed whether or not user is logged in

						if ($_SESSION['isLoggedIn'] == true) {
							echo "
							<li><a href='feed.php'>Feed</a></li>
						   <li><a href='members.php'>Members</a></li>
								<li><a href='profile.php?user=" . $_SESSION['loggedInUsername'] . "'>My Profile</a></li>
								<li><form action='' method='POST' id='logout'>
									<input type='submit' name='logout' class='btn' value='Logout'>
								</form></li>
								<div id='content'></div>
							";
						} else {
							echo "<li><a href='login.php'>Login/Register</a></li>";
						}
					?>
					</ul>
	      			<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				</div>
			</nav>
		</div>