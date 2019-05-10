<?php
// Include dbConfig file
require_once '../dbConfig.php';

// Get varibables from form
$title = mysqli_real_escape_string($link, $_POST['title']);
$kind = mysqli_real_escape_string($link, $_POST['kind']);
$startTime = mysqli_real_escape_string($link, $_POST['startTime']);
$location = mysqli_real_escape_string($link, $_POST['location']);

date_default_timezone_set('Asia/Ho_Chi_Minh');
$curtime = date('Y-m-d H:i:s');

$sql = "INSERT INTO matches(player_id, title, kind, startTime, status, loc, createdTime) VALUES
('vntdinh', '$title', '$kind', '$startTime', 1, '$location', '$curtime')";

if (mysqli_query($link, $sql)) {
  header('Location: /matchup/form-create-match?status=1', true);
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>