<?php
	session_start();
	
	$servername = "127.0.0.1";
 	$username = "root";
  	$password = "1470";
  	$dbname = "test_database";

  	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$ID = $_SESSION["ID"];
	
	$sql = "DELETE FROM user_main where ID = '$ID'";
	$result = mysqli_query($conn, $sql);

	$sql = "DELETE FROM friends where ID = '$ID' or friendID = '$ID'";
	$result = mysqli_query($conn, $sql);

	$sql = "DELETE FROM publish where ID = '$ID'";
	$result = mysqli_query($conn, $sql);

	header('Location: signout.php');

	$conn->close();
?>