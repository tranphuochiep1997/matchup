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
  <?php  include('../common/header.php'); ?>
  <div class="container">
  <div class="form-create-match-wrapper">
    
    <span class="title">Create new match</span>
    <span class="sub-title">Please provide some information</span>
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
        <label for="inputStartTime">Start time</label>
        <input type="datetime-local" id="inputStartTime" name="startTime" required />
      </div>

      <input class="btn" type="submit" value="Submit" />
    </form>
  </div>
  </div>
  
</body>

</html>