<?php
	session_start();
	session_destroy();
	echo "<p style=\"color:green\">";
	echo "Your account has been successfully deleted<br>";
	echo "</p>";


	echo"<meta http-equiv=\"refresh\" content=\"3;url=signup.htm\"/>";
	// echo "<a style=\"color:green; text-decoration:none;\" href=\"login.htm\">Back to login page</a>";
?>