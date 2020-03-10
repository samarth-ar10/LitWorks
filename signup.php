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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["name"])){
      $error = true;
    }
    else{
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $error = true;
      }
    }
    if(empty($_POST["password"])){
      $error = true; 
    }
    else{
      $password = test_input($_POST["password"]);
    }
    if(empty($_POST["confirmpassword"])){
      $error = true;
    }
    else{
      $confirmpassword = test_input($_POST["confirmpassword"]);
      if($confirmpassword!==$password){
        $error = true;
      }
    }
    if(empty($_POST["E-mail"])){
      $error = true;
    }
    else{
      $email = test_input($_POST["E-mail"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
      }
    }
  }
  if($error==false){      

      if($error==false){
        $_SESSION["Email"] = $email;
        $_SESSION["Password"] = $password;
        $_SESSION["ID"] = $ID;
        $_SESSION["ID1"] = $ID;
        // echo "Idhar aaya<br>";
        //$_SESSION["PID"] = 0;
        //header('Location: main.php'); 
      }
      else{
       // session_destroy();
        header('Location: errorsignup.htm');  
       }

      $sql = "INSERT INTO temp_user_main (userName, password, email)
      VALUES ('$name', '$password', '$email')";

      if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
      header('Location: /testingmail/confirmemail.php'); 
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
