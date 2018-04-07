<html>
<head></head>
<body>
	<?php 
		if (isset($_POST['reg_user'])) {
			echo $_POST['email'];
			echo "<br>";
			echo $_POST['password1'];
			echo "<br>";
			echo $_POST['password2'];
			echo "<br>";
			echo $_POST['username'];
			echo "<br>";
			echo $_POST['gender'];
			echo "<br>";
			echo $_POST['phone'];
		}
	 ?>
</body>
</html>