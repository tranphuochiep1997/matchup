<?php
require_once "../dbConfig.php";

$sql = "UPDATE matches SET status = 2, scoreA = ?, scoreB = ? where match_id = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
  mysqli_stmt_bind_param($stmt, "iii", $scoreA, $scoreB, $match_id);

  $scoreA = $_POST["scoreA"];
  $scoreB = $_POST["scoreB"];
  $match_id = $_POST["match_id"];

  if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php?id=$match_id");
    exit();
  } else {
    echo "Something went wrong. Please try again later";
  }
}

mysqli_stmt_close($stmt);
mysqli_close($link);
?>