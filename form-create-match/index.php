<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <title>Matchup</title>
</head>

<body>
  <?php include('../common/header.php'); ?>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <span class="title">Create new match</span>
        <span class="sub-title">Please provide some information</span>
      </div>
      <div class="card-body">
        <?php
        if (!isset($_COOKIE["player_id"])) {
          echo "<div class='alert alert-danger'> Please login to create match</div>";
        } else {
          if (isset($_GET["status"])) {
            echo "<div class='alert alert-success faded'>Match created successfully</div>";
          }
        }
        ?>
        <form action="action.php" method="post">
          <div class="form-group">
            <label for="inputTitle">Title</label>
            <input type="text" id="inputTitle" name="title" required />
          </div>

          <div class="form-group">
            <label for="inputKind">Kind: number of players for each team</label><br>
            <input type="radio" id="inputKind" name="kind" value="5" checked />5<br>
            <input type="radio" id="inputKind" name="kind" value="7" />7<br>
            <input type="radio" id="inputKind" name="kind" value="11" />11<br>
          </div>

          <div class="form-group">
            <label for="inputLocation">Location</label>
            <input list="listStadium" id="inputLocation" name="location" required />
            <datalist id="listStadium">
              <option value="Chuyên Việt"></option>
              <option value="Trang Hoàng"></option>
              <option value="Duy Tân"></option>
              <option value="Đại học thể dục thể thao"></option>
              <option value="An Phúc"></option>
              <option value="Paracel"></option>
              <option value="Tuyên sơn"></option>
            </datalist>
          </div>

          <div class="form-group">
            <label for="inputStartTime">Start time</label>
            <input type="datetime-local" id="inputStartTime" name="startTime" required />
          </div>

          <?php

          if (isset($_COOKIE["player_id"])) {
            //Normal button
            echo "<input style='background-color: #28a745; color: #fff;' class='btn' type='submit' value='Submit' />";
          } else {
            // Disabled button
            echo "<input 
            style='background-color: #28a745; color: #fff;' 
            class='btn' 
            type='submit' 
            disabled
            value='Submit' />";
          }
          ?>
        </form>
      </div>
    </div>
  </div>

  <script>
    const fadedElements = document.getElementsByClassName('faded');
    setTimeout(() => {
      for(let i = 0; i < fadedElements.length; i++) {
        fadedElements[i].remove();
      } 
    }, 4000);
  </script>
</body>

</html>