<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$street   = "";
$name    = "";
$city    = "";
$doj    = "";
$phoneno = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'employee');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $street = mysqli_real_escape_string($db, $_POST['street']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $doj = mysqli_real_escape_string($db, $_POST['doj']);
  $phoneno = mysqli_real_escape_string($db, $_POST['phoneno']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($name)) { array_push($errors, "name is required"); }
  if (empty($street)) { array_push($errors, "street is required"); }
  if (empty($city)) { array_push($errors, "city is required"); }
  if (empty($doj)) { array_push($errors, "doj is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phoneno)) { array_push($errors, "phoneno is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $employee_check_query = "SELECT * FROM employee WHERE username='$username' OR email='$email' ";
  $result = mysqli_query($db, $employee_check_query);
  $employee = mysqli_fetch_assoc($result);

  if ($employee) { // if user exists
    if ($employee['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($employee['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO employee (username, name, street, city, doj, phoneno, email, password) 
  			  VALUES('$username', '$name', '$street', '$city', '$doj','$phoneno','$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ...
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM employee WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>