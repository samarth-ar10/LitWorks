<?php
// Start the session
  session_start();
?>

<?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "1470";
  $dbname = "test_database";
  $comment="";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $PUBLISHNAME = $CONTENT = $ID = "";
  $error = false;
  $ID = $_SESSION["ID"];

  $currentbut="";


  if(isset($_POST['SubmitButton'])){ //check if form was submitted
    //$input = $_POST['inputText']; //get input text
    $message = "Success! You entered: ";
  }  

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["PUBLISHNAME"])){
      $error = true;
    }
    else{
      $PUBLISHNAME = test_input($_POST["PUBLISHNAME"]);
    }
    if(empty($_POST["CONTENT"])){
      $error = true;
    }
    else{
      $CONTENT = test_input($_POST["CONTENT"]);
    }
  }
  if($error==false){  

      echo "<script>";
      echo "function textAreaAdjust(o) {
          o.style.height = \"0px\";
          o.style.height = (0+o.scrollHeight)+\"px\";
        }";
      echo "</script>";  

      $sql = "SELECT EMAIL,USERNAME FROM user_main
      WHERE ID='$ID'";

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      echo "<!DOCTYPE html>";
      echo "<html>";
      echo "<head>";
      echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js\"></script>";
      echo "<script src=\"main.js\"></script>";
      echo "<style type=\"text/css\">";
      echo "</style>";

      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"main.css\">";
      echo "</head>";  
      echo "<body style=\"background-color:rgb(221, 224, 210);\">";
      echo "<script>";
      echo "function textAreaAdjust(o) {
  o.style.height = \"0px\";
  o.style.height = (0+o.scrollHeight)+\"px\";
 
}";
 
      echo "</script>";
      echo "<div id=\"head\" class=\"header\">";
        echo "<div class=\"hh\" >";
          echo "<a style=\"color:white; text-decoration:none\" href=\"main.php\">";
            echo "<h1 style=\"text-align:left;font-size:150%;padding-left:3;\">litworks</h1>";
          echo "</a>";
        echo "</div>";

        echo "<div class=\"hh\"  >";
          echo "<div class=\"hm\"  >";
         
            echo "<p style=\"text-align:center;font-size:150%;display:inline;\">".$row["USERNAME"];
            echo "<sup>".$ID."</sup></p>";
           
          echo"</div>";

      $sql = "SELECT count(FRIENDID) AS CFRIN FROM friends
      WHERE ID='$ID'";

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
          echo "<div class=\"hm\"  >";
            echo "<p style=\"text-align:center;font-size:150%\" >".$row["CFRIN"];
            echo "</p>";
          echo"</div>";
        echo "</div>";

        echo "<div class=\"hh\"  >";

        echo "</div>";
      echo "</div>";

      echo "<div id=\"contain\" class=\"container\">";
      
      echo "<div class=\"left\">";
            echo "<a href=\"yourcontent.php?ID1=".$ID."\" style=\"text-decoration:none;\">";
              echo "<h2 style=\"text-align:center;font-size:80%;color:#ffffff;\">Your Content</h2>";
            echo "</a>";
            echo "<hr style=\"color:white;\">";
            echo "<h3 style=\"margin-top:0px;text-align:center;color:white;\">updates</h3>";
            echo "<div style=\"width:96%;margin-left:2%;\">";
            $sql = "SELECT DISTINCT n.publishID, n.ID FROM notification as n,friends as f where n.ID=f.friendID and f.friendID in(SELECT friendID FROM friends where ID=".$ID.") ORDER BY n.publishID DESC LIMIT 0,50";

            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result)>0){
              while($row=mysqli_fetch_assoc($result)){
                echo "<a style=\"text-decoration:none;\" href=\"yourcontent.php?ID1=".$row["ID"]."\"><p style=\"text-align:center;color:white;text-decoration:none;\">".$row["ID"]." just posted->".$row["publishID"]."</p></a>";
              }
            }
            echo "</div>";
      echo "</div>"; 
      echo "<div class=\"mid\">";
      $sql="drop view listp";
      $result = mysqli_query($conn, $sql);
      $sql="create or replace view listp(publishID) as (select publishID from publish where publish.ID!=".$ID." order by rand() limit 0,10)";
      $result = mysqli_query($conn, $sql);
     
      $start=0;
      $end=$start+10;
      $sql = "SELECT lp.publishID,p.content,p.publishName,um.ID,um.EMAIL,um.USERNAME FROM user_main as um,publish as p,listp as lp where lp.publishID=p.publishID and um.ID=p.ID LIMIT ".$start.", ".$end;

      $result = mysqli_query($conn, $sql);
     
      echo "<div class=\"right\">";
      if (mysqli_num_rows($result) > 0) {
         
          while($row = mysqli_fetch_assoc($result)) {

              echo "<div class=\"content\">";
                  echo "<p style=\"text-align:center;color:#000000;font-size:128%;\">".$row["publishName"]."<sup style=\"font-size:80%\"><b>".$row["publishID"]."</b></sup></php>";
                 
                  echo "<p style=\"display:inline;padding-left:5;text-align:left;color:#000000;font-size:100%;float:left\">".$row["USERNAME"]."<sup style=\"font-size:80%\"><b>".$row["ID"]."</b></sup></p>";
                  echo "<p style=\"display:inline;padding-right:5;text-align:right;color:#000000;font-size:90%;float:right;\">".$row["EMAIL"]."</p>";
               echo "<br><hr><br><p class=\"minimize\" style=\"padding:10px;text-align:left;font-size:100%;\">".$row["content"]."</p>";
		echo"</div>";
              echo "<a href=\"#\" onclick=\"showmen(".$row["publishID"].")\"><div class=\"content\" style=\"width:30%;float:right;margin-top:0%;background-color:rgb(4, 58, 34);color:white;text-align:center;\">";

              echo "<p style=\"display:inline;font-size:90%;\">react</p>";
           echo "</div></a>";
//////////////////////////////////////////////
           
  echo"<div id=\"".$row["publishID"]."\" class=\"react\" >";
      
        echo"<a href=\"likes.php?ID1=".$row["publishID"]."\" target=\"_blank\"><div class=\"hh\" style=\"border-top-left-radius:12px;height:6%;background-color:rgb(3, 47, 76);width:50%;border:none;float:left;\">";
          echo "<p style=\"width:49.3%;float:center;margin-top:5%;color:white;text-align:center;\">like</p>";
        echo "</div></a>";


        echo"<a style=\"text-decoration:none;\" href=\"yourcontent.php?ID1=".$row["ID"]."\"><div class=\"hh\" style=\"border-top-right-radius:12px;height:6%;background-color:rgb(3, 47, 76);width:49.3%;border:none;float:right;\">";
          echo "<p style=\"width:50%;float:center;margin-top:5%;color:white;text-align:center;padding-right:15px;\">link</p>";
        echo "</div></a>";
        
        echo "<div class=\"content\" style=\"width:100%;margin-top:0%;background-color:rgb(4, 58, 34);color:white;text-align:center;border-radius:0;\">";

              echo "<p style=\"display:inline;font-size:120%;\">".$row["publishName"]."<sup>".$row["publishID"]."</p>";
  echo "</div>";


        echo"<div class=\"hh\" style=\"height:75%;width:100%;background-color:rgb(154, 164, 149);border:12px;color:balck;font-size:75%;text-align:left; overflow-y:scroll;overflow-x:scroll
            \">";
          echo "<p>EMAIL->".$row["EMAIL"]."</p>";
          echo "<p>user name->".$row["USERNAME"]."</p>";
          echo "<p>user id->".$row["ID"]."</p>";
        $pql="SELECT count(DISTINCT likeID) as likeID FROM likes WHERE likeID in(SELECT publishID FROM publish where ID=".$row["ID"].")  " ;
        $res = mysqli_query($conn, $pql);
        $ro=mysqli_fetch_assoc($res);
          echo "<p>user's total Likes->".$ro["likeID"]."</p>";
          $pql="SELECT count(DISTINCT ID) as plikedID FROM likes where likeID=".$row["publishID"] ;
        $res = mysqli_query($conn, $pql);
        $ro=mysqli_fetch_assoc($res);
        echo "<p>post Liked->".$ro["plikedID"]."</p>";
        echo "</div>";

        echo"<a href=\"addfriendreact.php?ID1=".$row["ID"]."\" target=\"_blank\"><div class=\"hh\" style=\"color:white;background-color:rgb(0,100,0);border-radius:12px;border:none;width:100%; \">";
            
              echo "<p>Add friend</p>";
            
        echo "</div></a>";
      echo "</div>";
          }

      }
      else {
          echo $ID;
          echo "--0 results";
      }
    
      echo "</div>";
      //////////////////////////////////////////////////////////
      echo "<div class=\"dropdown\">";
      echo "<div class=\"menup\">";
      echo  "<img src=\"menu.png\" alt=\"write\"  style=\"float:right;height:40;width:40;\">";
     
      echo "<div class=\"dropdown-content\">";
            // <a onclick=\"seachas('Search')\" href=\"#\">Search</a>
      echo "<a href=\"addfriendmain.php\">Add Friend</a>
            <a href=\"deleteaccount.php\">Delete Your Account</a>
            <a href=\"logout.php\">Logout</a>

            </div>";
  
      echo "</div>";
      echo "</div>";
      /////////////////////////////////////////////////////////////
      
  //     /////////////////////////////////////////////////////////
      echo "<div class=\"mendown\">";
      echo "<a href=\"braindrain.htm\">";
      echo  "<img src=\"pen.gif\" alt=\"Write\"  style=\"float:right;\">";
      echo "</a>";

      echo "</div>";
      /////////////////////////////////////////////////////////
      echo "</div>";
      echo "</div>";
      ///////////////////////////////////////////////////////////
      
           //////////////////////////////////////////////////////////
      
      echo "</body>";
      echo "</html>";



  }
  else{
    header('Location: test.php'); 
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $conn->close();
?>
