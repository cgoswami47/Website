<?php
session_start();

// initializing variables
//$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'chandu', 'Goswami@1997', 'crazy');
if (!$db) {
    throw new Exception(mysqli_error($db)."Database Connection Error");
	echo "Database Error\n";
}

if (isset($_POST['forgot_pass'])) {
	  /*
	  $email = mysqli_real_escape_string($db, $_POST['email']);
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (count($errors) == 0) {
  */
    $_SESSION['forgot'] = true; 
<<<<<<< HEAD
    header('location:forgot.html');
  //}
	//else
	//echo "Error in opening\n";
}
=======
    header('location:forgot.html')
  }

>>>>>>> e59ed60ec9ff8042fe1f2af0a6440f162f37e7d5
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password2']);
  $phone = mysqli_real_escape_string($db,  $_POST['phone']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $activation_code=rand(100,999);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

if (empty($phone)) { array_push($errors, "Phone Number  is required"); }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  
  //$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $user_check_query = "SELECT * FROM users WHERE  email='$email' LIMIT 1" ;
  $result = mysqli_query($db, $user_check_query);

 if (!$result) {
		throw new Exception(mysqli_error($db)."[ $user_check_query]");
	 	echo "Database User Check failed";
	}

  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
   //if ($user['username'] === $username) {
     // array_push($errors, "Username already exists");
    

    
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }

    if ($user['phone'] === $phone) {
      array_push($errors, "phone number already exists");
    }
  
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password,phone, gender, activation_code) 
  			  VALUES('$username', '$email', '$password', '$phone', '$gender', '$activation_code')";
  	$done = mysqli_query($db, $query);
	
	if (!$done) {
    throw new Exception(mysqli_error($db)."[ $query]");
	echo "Database write failed";
}
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now registered";
	echo "You are registered";
  	header('location: index.php');
  }
}

// ... 
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
	echo "Email Empty\n";
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
	echo "Password empty\n";
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);
	if (!$results) {
    throw new Exception(mysqli_error($db)."[$query]");
	echo "Inavlid Username or Password\n";
}
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['success'] = "You are now logged in";
	  echo "logging In";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>