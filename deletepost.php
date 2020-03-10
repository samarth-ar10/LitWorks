<?php
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

  $ID = $_SESSION["ID"];
  $publishID = $_GET['postID'];	  

  $sql = "DELETE FROM publish where publishID = '$publishID'";
  $result = mysqli_query($conn, $sql);

  echo "<p style=\"color:green\">";
  echo "Your post has been deleted<br>";
  echo "</p>";

  echo"<meta http-equiv=\"refresh\" content=\"2;url=yourcontent.php?ID1=".$ID."\"/>";

  $conn->close(); 
?>