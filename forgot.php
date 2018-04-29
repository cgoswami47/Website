<?php 
error_reporting(0);
if($_POST['submit']=='Send')
{
//keep it inside
$email=$_POST['email'];
$code = $_GET['activation_code'];
$con=mysqli_connect("localhost","chandu","Goswami@1997","crazy");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$query = mysqli_query($con,"select * from users where email='$email'")
or die(mysqli_error($con)); 

 if (mysqli_num_rows ($query)==1) 
 {
$code=rand(100,999);
$message="You activation link is: http://crazyprofitbazaar.com/resetpass.php?email=$email&code=$code";
$to = $email;
 }
function send_mail($email, $recipient_name, $message='Password reset link')
{
    require("phpmailer.php");

    $mail = new PHPMailer();

    $mail->CharSet="utf-8";
    $mail->IsSMTP();                                      // set mailer to use SMTP
    $mail->Host = "webmailer.crazyprofitbazaar.com";  // specify main and backup server
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->Username = "recovery@crazyprofitbazaar.com";  // SMTP username
    $mail->Password = "Goswami@1997"; // SMTP password

    $mail->From = "recovery@crazyprofitbazaar.com";
    $mail->FromName = "Chandrashekhar Goswami";
    $mail->AddAddress($email, $recipient_name);

    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
    $mail->IsHTML(true);                                  // set email format to HTML (true) or plain text (false)

    $mail->Subject = "Password reset link";

//mail($to,$subject,$message,$headers);
echo 'Email sent<br>';
$query2 = mysqli_query($con,"update users set activation_code='$code' where email='$email' ")
or die(mysqli_error($con)); 
}
{
echo 'No user exist with this email id';

};

?>
