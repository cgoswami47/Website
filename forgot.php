<?php 
error_reporting(0);
<<<<<<< HEAD
//if($_POST['submit']=='Send')
if(isset($_SESSION['forgot']))
=======
if($_POST['submit']=='Send')
>>>>>>> 1d139c9591dea11af23fcf73f5e6b3058bd60fce
{
//keep it inside
$email=$_POST['email'];
$code = $_GET['activation_code'];
<<<<<<< HEAD
$con=mysqli_connect("localhost","chandu","Goswami@1997","crazy");
=======
$con=mysqli_connect("127.0.0.1","root","","registration");
>>>>>>> 1d139c9591dea11af23fcf73f5e6b3058bd60fce
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
<<<<<<< HEAD
$message="You activation link is: http://crazyprofitbazaar.com/resetpass.php?email=$email&code=$code";
=======
$message="You activation link is: http://bing.fun2pk.com/resetpass.php?email=$email&code=$code";
>>>>>>> 1d139c9591dea11af23fcf73f5e6b3058bd60fce
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
<<<<<<< HEAD
<!--
<form action="forgot.php" method="post">
Enter you email ID: <input type="text" name="email">
<input type="submit" name="sut" value="Send">
</form>
-->
=======
<form action="forgot.php" method="post">
Enter you email ID: <input type="text" name="email">
<input type="submit" name="submit" value="Send">
</form>
>>>>>>> 1d139c9591dea11af23fcf73f5e6b3058bd60fce
