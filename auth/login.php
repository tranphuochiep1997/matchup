<?php include('server.php') ?> 
<!DOCTYPE html>
<html>
<head>
  <title>Football match-making website</title>
  <link rel="stylesheet" type="text/css" href="../auth/index.css">
</head>
<body>
  <div class ="background"></div>
  <div class="form">
  <div class="header">
    <h2>Login</h2>
  </div>
     
  <form method="post" action="login.php">
    <?php include ('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="player_id" >
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_player">Login</button>
    </div>
    <p>
        Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
  </div>
  
  
</body>
</html>