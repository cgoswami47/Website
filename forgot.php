<?php 
error_reporting(0);
//if($_POST['submit']=='Send')
if(isset($_SESSION['forgot']))
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
mail($email, "crazyprofitbazaar", $message);
echo 'Email sent<br>';
$query2 = mysqli_query($con,"update users set activation_code='$code' where email='$email' ")
or die(mysqli_error($con)); 
}
else
{
echo 'No user exist with this email id';

}}

?>
<!--
<form action="forgot.php" method="post">
Enter you email ID: <input type="text" name="email">
<input type="submit" name="sut" value="Send">
</form>
-->