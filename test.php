<!DOCTYPE html>
<html>
<body>
<form method="POST" action="">
    <input type="submit" name="name" value="like"></input>
</form>
<?php
if(isset($_POST['name']) && !empty($_POST['name'])) {
    echo 'Welcome, ' . $_POST['name']; 
}
?>
</body>
</html>