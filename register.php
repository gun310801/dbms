<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration for employee</title>
  <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
  <div class="hero">
  <div class="header">
    <h2>Register</h2>
  </div>
  
  <form method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
     <div class="input-group">
      <label>name</label>
      <input type="text" name="name" value="<?php echo $name; ?>">
    </div>
     <div class="input-group">
      <label>street</label>
      <input type="text" name="street" value="<?php echo $street; ?>">
    </div>
    <div class="input-group">
      <label>city</label>
      <input type="text" name="city" value="<?php echo $city; ?>">
    </div>
    <div class="input-group">
      <label>doj</label>
      <input type="text" name="doj" value="<?php echo $doj; ?>">
    </div>
    <div class="input-group">
      <label>phoneno</label>
      <input type="text" name="phoneno" value="<?php echo $phoneno; ?>">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password_1">
    </div>
    <div class="input-group">
      <label>Confirm password</label>
      <input type="password" name="password_2">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
</body>
</html>