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
  $ID1 = $_GET["ID1"];
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
      WHERE ID='$ID1'";

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
            echo "<sup>".$ID1."</sup></p>";
           
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
      $sql = "SELECT publishName FROM publish where publish.ID=".$ID1;

      $result = mysqli_query($conn, $sql);
      echo "<div class=\"left\">";
            echo "<a href=\"yourcontent.php?ID1=".$ID."\" style=\"text-decoration:none;\">";
              echo "<h2 style=\"text-align:center;font-size:80%;color:#ffffff;\">Content</h2>";
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
      $sql = "SELECT publishID,content,publishName FROM publish as p where p.ID=".$ID1." ORDER BY publishID DESC LIMIT ".$start.", ".$end;
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
              echo "<div class=\"content\" style=\"width:100%;float:left;margin-top:0%;background-color:inherit;  \">";

        if($ID==$ID1){
          echo "<a href=\"deletepost.php?postID=".$row["publishID"]."\" style=\"text-decoration:none;\">";
          echo "<div style=\"width:30%;float:left;background-color:rgb(4, 58, 34);color:white;text-align:center;border-radius:9px;\">";
          echo "<p style=\"display:inline;font-size:90%;margin-top:0px;margin-bottom:0px;color:white;\">delete</p>";
          echo "</div></a>";
          echo "<a href=\"editpost.php?publishID=".$row["publishID"]."\"><div style=\"width:30%;float:right;background-color:rgb(4, 58, 34);color:white;text-align:center;border-radius:9px;\">";                    
              echo "<p style=\"display:inline;font-size:90%;color:white;\">edit</p>";
      echo "</div></a>";
          }
      else{
        echo "<a href=\"#\" onclick=\"showmen(".$row["publishID"].")\"><div class=\"content\" style=\"width:30%;float:right;margin-top:0%;background-color:rgb(4, 58, 34);color:white;text-align:center;\">";

              echo "<p style=\"display:inline;font-size:90%;\">react</p>";
           echo "</div></a>";

  echo"<div id=\"".$row["publishID"]."\" class=\"react\" style=\"\">";
      
        echo"<a href=\"likes.php?ID1=".$row["publishID"]."\" target=\"_blank\"><div class=\"hh\" style=\"border-top-left-radius:12px;height:6%;background-color:rgb(3, 47, 76);width:50%;border:none;float:left;\">";
          echo "<p style=\"width:49.3%;float:center;margin-top:5%;color:white;text-align:center;\">like</p>";
        echo "</div></a>";


        echo"<div class=\"hh\" style=\"border-top-right-radius:12px;height:6%;background-color:rgb(3, 47, 76);width:49.3%;border:none;float:right;\">";
          echo "<p style=\"width:50%;float:center;margin-top:5%;color:white;text-align:center;padding-right:15px;\">details</p>";
        echo "</div>";
        
        echo "<div class=\"content\" style=\"width:100%;margin-top:0%;background-color:rgb(4, 58, 34);color:white;text-align:center;border-radius:0;\">";

              echo "<p style=\"display:inline;font-size:120%;\">".$row["publishName"]."<sup>".$row["publishID"]."</p>";
  echo "</div>";

        $pql="SELECT EMAIL,USERNAME FROM user_main WHERE ID=".$ID1;
        $res = mysqli_query($conn, $pql);
        $ro=mysqli_fetch_assoc($res);

        echo"<div class=\"hh\" style=\"height:90%;width:100%;background-color:rgb(154, 164, 149);border:12px;color:balck;font-size:75%;text-align:left; overflow-y:scroll;overflow-x:scroll
            \">";
          echo "<p>EMAIL->".$ro["EMAIL"]."</p>";
          echo "<p>user name->".$ro["USERNAME"]."</p>";
          echo "<p>user id->".$ID1."</p>";
          $pql="SELECT count(DISTINCT likeID) as likeID FROM likes WHERE ID=".$ID1;
        $res = mysqli_query($conn, $pql);
        $ro=mysqli_fetch_assoc($res);

          echo "<p>Likes->".$ro["likeID"]."</p>";
        echo "</div>";

        
      echo "</div>";
    }
  echo "</div>";
          }
      //  echo "<div style=\"width:100%;\"><button onclick=\"more\" style=\"text-align:center;width:10%;margin-right:45%;margin-left:45%;\">more</button>";
      // echo "</div>";i
      }
      else {
          if($ID==$ID1){
              echo "<a href=\"braindrain.htm\" style=\"text-decoration:none;\"><h1 style=\"color:green\">Go ahead and write someting!!!!<h1></a>";
          }
          
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
      /////////////////////////////////////////////////////////
      echo "<div class=\"mendown\">";
      echo "<a href=\"braindrain.htm\">";
      echo  "<img src=\"pen.gif\" alt=\"Write\"  style=\"float:right;\">";
      echo "</a>";

      echo "</div>";
      /////////////////////////////////////////////////////////
      echo "</div>";
      echo "</div>";
      ///////////////////////////////////////////////////////////
      
      echo "<div id=\"seacha\">";
        echo "<div style=\"height: 10%;background-color:rgb(0,36,0);margin-bottom:0px;border-top-right-radius:25px;border-top-left-radius:25px;\">";
            echo "<img src=\"back.png\" onclick=\"seaback()\" style=\"float:left;height:40px;width:40px;border-radius:50%; margin-top:1%;margin-left:1%;
            \">";
            echo "<div id=\"seacha-top0\" class=\"seacha-top\" >";
              echo "<p style=\"text-align:center;display:inline;font-size:160%;height:100%;\">Search</p>";
            echo "</div>";
            echo "<div id=\"seacha-top1\" class=\"seacha-top\">";
              echo "<p style=\"text-align:center;display:inline;font-size:160%;\">Chat</p>";
            echo "</div>";
        echo "</div>";
        echo "<div id=\"sear\" class=\"sear\">";
          echo "<div style=\"height=15px;width:100%\">";
            echo "<form>
                    <input type=\"text\" name=\"search\" placeholder=\"Search..\">
                  </form>"      ;
          echo "</div>";
        echo "</div>";
              echo "<div id=\"sear\" class=\"sear\">";
          echo "<div style=\"height=15px;width:100%\">";
            echo "<form>
                    <input type=\"text\" name=\"search\" placeholder=\"Search..\">
                  </form>"      ;
          echo "</div>";
        echo "</div>";
        echo "<div id=\"sear\" class=\"sear\">";
          echo "<div style=\"height=15px;width:100%\">";
            echo "<form>
                    <input type=\"text\" name=\"search\" placeholder=\"Search..\">
                  </form>"      ;
          echo "</div>";
        echo "</div>";
        echo "<div id=\"sear\" class=\"sear\">";
          echo "<div style=\"height=15px;width:100%\">";
            echo "<form>
                    <input type=\"text\" name=\"search\" placeholder=\"Search..\">
                  </form>"      ;
          echo "</div>";
        echo "</div>";
      echo "</div>";
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
