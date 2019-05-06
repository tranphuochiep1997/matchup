<?php
// Include dbConfig file
require_once '../dbConfig.php';

// Get varibables from form
$title = mysqli_real_escape_string($link, $_POST['title']);
$kind = mysqli_real_escape_string($link, $_POST['kind']);
$startTime = mysqli_real_escape_string($link, $_POST['startTime']);

$sql = "INSERT INTO matches(title, kind, startTime, status) VALUES
('$title', '$kind', '$startTime', 1)";

if (mysqli_query($link, $sql)) {
  echo "<script>
    alert('Match created successfully');
    window.history.back();
  </script>";
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>