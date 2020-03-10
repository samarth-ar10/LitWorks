<?php
// Start the session
  session_start();
?>

<!DOCTYPE html>
<head>
  <link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<html>
<body>
    <form action="addfriend.php" method="post">
	<p>Select ID of the person you want to follow</p>
    	<input type="text" name="IDF" placeholder="ID"><br>
    	<input type="submit" value="Submit">
    </form>
</body>
</html>
