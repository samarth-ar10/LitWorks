<?php
	session_start();
?>

<?php
	
	$servername = "127.0.0.1";
  	$username = "root";
  	$password = "1470";
  	$dbname = "test_database";

  	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$ID = $_GET['tempID'];
	echo "$ID";
	$sql = "SELECT * FROM temp_user_main WHERE tempID = ".$ID;
	$result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){

       $EMAIL = $row["email"];
       $PASSWORD = $row["Password"];
       
       $sql = "DELETE FROM temp_user_main WHERE tempID = '$ID'";
       if(mysqli_query($conn, $sql)){
       		// $sql = "DELETE FROM temp_user_main WHERE tempID = '$ID'";
       		// if(mysqli_query($conn, $sql)){
       			header('Location: login.htm');
       		// }
       }
       else{
          echo "NHP";
       }
    } 	
?>