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
  $IDF = "";
  $error = false;
  $ID = $_SESSION["ID"];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["IDF"])){
      $error = true;
    }
    else{
      $IDF = test_input($_POST["IDF"]);
    }
  }
  if($error==false){      
      $sql = "INSERT INTO friends (friendID,ID)
      VALUES ('$IDF', '$ID')";

      if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
      header('Location: main.php'); 
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
