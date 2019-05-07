<?php
// Include dbConfig file
require_once '../dbConfig.php';

// Get varibables from form

$sql = "INSERT INTO matches(title, kind, startTime, status) VALUES
('test', 'test', 'test', 1)";

if (mysqli_query($link, $sql)) {
  echo "<script>
    alert('Detail created successfully');
  </script>";
  $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
  header("location: /matchup/match_detail/index.php?status=1");
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>