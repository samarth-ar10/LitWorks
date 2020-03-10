<?php
    // Start the session
    session_start();
?>

<?php
// Pear Mail Library
//require_once "Mail.php";

include('Mail.php');
include('Mail/mime.php');

$servername = "127.0.0.1";
$username = "root";
$password = "1470";
$dbname = "test_database";

$email = $_SESSION["Email"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

      //send mail
        $from = '<noreplylitworks@gmail.com>';
        $to = '<'.$email.'>';
        
        $subject = 'Hello';
        $text = 'This is a text message.';                                  // Text version of the email
        $sql = "SELECT tempID FROM temp_user_main where email='$email'";
        $result = mysqli_query($conn, $sql);
        if($row=mysqli_fetch_assoc($result)){
            $tempID = $row["tempID"];
            $html = "<html><body>
                    <p> Please click the link or copy paste it in the url to authorize your account</p>
                    <a href=\"http://127.0.0.1/confirm.php?tempID=".$tempID."\">Confirm</a>
                    <p style=\"color:red;\"><b> Tere mein bhi chal gaya finally </b></p>
                    </body></html>";  // HTML version of the email
            $crlf = "\n";

            //$body = "<html><body><a href='login.htm'>Login</a></body></html>";



             $headers = array(
                 'From' => $from,
                 'To' => $to,
                 'Subject' => $subject
             );

            //'MIME-Version: 1.0' . "\r\n";
            //'Content-type: text/html; charset=iso-8859-1' . "\r\n";


            // Creating the Mime message
            $mime = new Mail_mime($crlf);

            // Setting the body of the email
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html);

            $body = $mime->get();
            $headers = $mime->headers($headers);


            $smtp = Mail::factory('smtp', array(
                    'host' => 'ssl://smtp.gmail.com',
                    'port' => '465',
                    'auth' => true,
                    'username' => 'noreplylitworks@gmail.com',
                    'password' => 'HelikSamarth'
                ));

            $mail = $smtp->send($to, $headers, $body);

            if (PEAR::isError($mail)) {
                echo('<p>' . $mail->getMessage() . '</p>');
            } else {
                echo $tempID;
                echo('<p>Please check your E-Mail for completing the registration process</p>');
            }
        }
    
?>