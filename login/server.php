<?php
session_start();

// initializing variables
$player_id = "";
$name    = "";
$elo = 100;
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'matchup');

// REGISTER PLAYER
if (isset($_POST['player_register'])) {
  // receive all input values from the form
  $player_id = mysqli_real_escape_string($db, $_POST['player_id']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password_confirm = mysqli_real_escape_string($db, $_POST['password_confirm']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($player_id)) { array_push($errors, "Username is required"); }
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($password != $password_confirm) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a player does not already exist with the same player
  $user_check_query = "SELECT * FROM player WHERE player_id='$player_id' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $player = mysqli_fetch_assoc($result);
  
  if ($player) { // if player exists
    if ($player['player_id'] === $player_id) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register player if there are no errors in the form
  if (count($errors) == 0) {
  	$query = "INSERT INTO player (player_id, name, password,elo) 
  			  VALUES('$player_id', '$name', '$password', $elo)";
  	mysqli_query($db, $query);
  	$_SESSION['player_id'] = $player_id;
  	$_SESSION['success'] = "You are now logged in";
    setcookie("player_id", $player_id, time()+3600);
  	header('location: /matchup/home/');
  }
}
//Login player
if (isset($_POST['login_player'])) {
  $player_id = mysqli_real_escape_string($db, $_POST['player_id']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($player_id)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM player WHERE player_id='$player_id' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['player_id'] = $player_id;
      $_SESSION['success'] = "You are now logged in";
      header('location: /matchup/home/');
      setcookie("player_id", $player_id, time()+3600);
    }else {
      array_push($errors, "Wrong username/password");
    }
  }
}

?>