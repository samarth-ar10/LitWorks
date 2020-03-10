<?php
	// Start the session
  	session_start();
?>

<?php
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
	  $name = $password = $confirmpassword = $email = "";
	  $error = false;
	  $email = $_SESSION["Email"];
	  $sql = "SELECT tempID FROM temp_user_main WHERE email = '$email'";
	  if ($conn->query($sql) === TRUE) {
          //send mail
	  	  header('Location: /testingmail/confirmemail.php');
      } else {
          echo "Error: Nahi hua. Mara le<br>";
      } 
?>