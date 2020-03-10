<?php
	session_start();
	session_destroy();
	echo "<p style=\"color:green\">";
	echo "You have been logged out<br>";
	echo "</p>";


	echo"<meta http-equiv=\"refresh\" content=\"3;url=login.htm\"/>";
	// echo "<a style=\"color:green; text-decoration:none;\" href=\"login.htm\">Back to login page</a>";
?>