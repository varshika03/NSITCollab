<?php 


	// include("connect.php");
session_start(); //this necessary? If it's already included on the other page this is included?
echo "PHP IS CALLED";
//include("connect.php");

// ========= CONNECT TO DATABASE ========= //
//opens connection and returns the object.
//I can't seem to pass this to other functions anymore?
function connect_database() {
	//Sulley information
	// $username = "qu721018";
	// $password = "UZNR3134JoF!";
	// $database = "qu721018";

	//local setting information
	$username = "root";
	$password = "DaSQStUsacc1234";
	$database = "proto";

	// Begin mysql OOP connection 
	$mysqli_connection = new mysqli("localhost", "$username", "$password", "$database"); //create database object
	//checks error
	if (mysqli_connect_error()) { //A string that describes the error. NULL is returned if no error occurred.
		echo mysqli_connect_error(); 
		exit;
	}
}

// ========= LOGIN TO DATABASE ========= //
//encrypts, connects to database, queries, close
function validate_current_password($username, $current_password) {

	//for some reason, I have to declare this again even though it's included already
	$connection = mysqli_connect("localhost" , "root" , "jayati05", "root") or die(mysqli_error());
	
	//not to get confused with connection $username, this is local to this function
	$username = $username;
	$current_password = sha1($current_password);

	$sql = "SELECT 1 FROM users_master 
			WHERE username = '$username' 
			AND password = '$current_password'";

	// Check to see if user and pass exists
	$result = mysqli_query($connection, $sql);

	$count = mysqli_num_rows($result); //grabs int of row

	if( $count == 1 ) {
		echo "Check!";
	} else {
		echo "Invalid password.";
	}
	
}

// ========= CHANGE PASSWORD QUERY ========= //
function change_password($username, $new_password) {

	$connection = mysqli_connect("localhost" , "root" , "jayati05", "root") or die(mysqli_error());
		
	$new_password = sha1($new_password);

	$sql = "UPDATE users_master
			SET password = '$new_password'
			WHERE username = '$username'";

	$result = mysqli_query($connection, $sql);

	echo "Password successfully changed! Redirecting to profile...";
	echo("<meta http-equiv='refresh' content='1; url=profile.php?user=" . $username . "'/>");
	
}

// ========= CHANGE EMAIL QUERY ========= //
function change_email($username, $new_email) {

	echo "I've made it this far";
	$connection = mysqli_connect("localhost" , "root" , "jayati05", "root") or die(mysqli_error());

	$sql = "UPDATE users_master
			SET email = '$new_email'
			WHERE username = '$username'";

	$result = mysqli_query($connection, $sql);

	echo "Email is successfully changed!";
	
}

// ========= CHANGE EMAIL QUERY ========= //
// function delete_account($username) {

// 	$connection = mysqli_connect("localhost" , "root" , "DaSQStUsacc1234", "proto") or die(mysqli_error());

// 	$sql = "DELETE FROM users_master
// 			WHERE CustomerName='Alfreds Futterkiste';";

	/*
		1. Select the row of the user.
		2. Grab the user type for Table
		3. Grab the user id for WHAT'S in the table
		4. Delete the row from the two table.
	*/
// 	$sql = "SELECT users_master.'$username', Customers.CustomerName, Orders.OrderDate
// 			FROM Orders
// 			INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;";

// 	$result = mysqli_query($connection, $sql);

// 	echo "Password successfully changed! Redirecting to profile...";
// 	echo("<meta http-equiv='refresh' content='1; url=index.php'/>");
	
// }


/* SWITCH STATEMENTS */
$action = $_POST["action"];
echo $action;
switch ($action) {
	case "validate_current_password":
		$current_password = $_POST["current_password"];
		validate_current_password($_SESSION["loggedInUsername"], $current_password);
		break;
	case "change_password":
		$new_password = $_POST["new_password"];
		change_password($_SESSION["loggedInUsername"], $new_password);
		break;
	case "change_email":
		echo "HERE?";
		$new_email = $_POST['new_email'];
		change_email($SESSION['loggedInUsername'], $new_email);
		break;
	case "delete_account":
		delete_account($SESSION['loggedInUsername']);
		break;
}

?>