<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<div class ="background"></div>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php"> 
    <?php include ('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="player_id">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_confirm">
  	</div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name">
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="player_register">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>