<?php

include("connect.php");

// Retrieve all users from database
$sql = "SELECT * FROM users_master ORDER BY username ASC";
$result = mysqli_query($connection, $sql);

// output data of each row
while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - Name: " . $row["Title"]. "Info: " . $row["Description"]. "<br>";
    $id = $row['id'];
    $username = $row['username'];
    $type = $row['type'];

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

    $return_arr[] = array(
        "id" => $id,
        "username" => $username,
        "type" => $type,
    	"name" => $name, 
    	"picture" => $picture);


//            $payload = json_encode($row);
//            echo $payload;
}


//    echo "cool";
echo json_encode($return_arr);
mysqli_close($connection);


?>
