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
  $IDF = intval($_GET['ID1']);
  $error = false;
  $ID = $_SESSION["ID"];

  if($error==false){      
      $sql = "INSERT INTO friends (friendID,ID)
      VALUES ('$ID', '$IDF')";

      if ($conn->query($sql) === TRUE) {
          echo "<script>window.close();</script>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
      //header('Location: mainpage.php'); 
  }
  else{
    header('Location: errorsignup.htm');  
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $conn->close();
?>

