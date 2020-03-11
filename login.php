<?php
// Start the session
  session_start();
?>
<?php
$servername = "fenrir-so.tech";
$username = "root";
$password = "1470";
$dbname = "test_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  $Email = $Password = $ID = "";
  $error = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["email"])){
      $error = true;
    }
    else{
      $Email = test_input($_POST["email"]);
    }
    if(empty($_POST["Password"])){
      $error = true; 
    }
    else{
      $Password = test_input($_POST["Password"]);
      $sql = "SELECT password FROM user_main WHERE email='$Email'";
      $result = $conn->query($sql);

      if($result->num_rows > 0){
        if($row = $result->fetch_assoc()){          
          if($row["password"]!=$Password){
              $error = true;    
          }
        }
      }
      else{
  $error = true;
      }
      $sql = "SELECT ID FROM user_main WHERE email='$Email'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        if($row = $result->fetch_assoc()){          
          $ID = $row["ID"];
        }
      }
    }
  }
  if($error==false){
    $_SESSION["Email"] = $Email;
    $_SESSION["Password"] = $Password;
    $_SESSION["ID"] = $ID;
    $_SESSION["ID1"] = $ID;
    header('Location: main.php'); 
  }
  else{
    // session_destroy();
    header('Location: errorlogin.htm');  
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$conn->close();
?>