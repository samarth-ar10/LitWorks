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


  $ID = $_SESSION["ID"];
  $publishID = intval($_GET['ID1']);

  $sql = "INSERT INTO likes(ID,likeID) VALUES('$ID','$publishID')";
  if ($conn->query($sql) === TRUE) {
          echo "<script>window.close();</script>";
  } else {
      echo $publishID."<br>";
      echo "Error: " . $sql . "<br>" . $conn->error;
  }   
  $conn->close();
?>