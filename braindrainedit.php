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

  $publishName = $content = $ID = $publishID = "";
  $error = false;
  $ID = $_SESSION["ID"];
  $publishID = $_SESSION["publishID"];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["PUBLISHNAME"])){
      $error = true;
    }
    else{
      $publishName = test_input($_POST["PUBLISHNAME"]);
    }
    if(empty($_POST["CONTENT"])){
      $error = true; 
    }
    else{
      $content = test_input($_POST["CONTENT"]);
    }
  }
  if($error==false){      
      $sql = "UPDATE publish SET publishName = '$publishName', content = '$content' WHERE publishID = '$publishID'";

      if ($conn->query($sql) === TRUE) {
          echo "<p style=\"color:green\">";
          echo "Your post has been edited<br>";
          echo "</p>";

          echo"<meta http-equiv=\"refresh\" content=\"2;url=yourcontent.php?ID1=".$ID."\"/>";
    } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }
  else{
    // header('Location: errorsignup.htm');  
    echo $ID;
    echo $publishName;
    echo $content; 
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $conn->close();
?>

