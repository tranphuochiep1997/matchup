<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail</title>
  <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
  <?php  include('../common/header.php'); ?>
  <div class="container">
    <div class="row match-detail">
        <div class="column1">
            <h3>Paticipate the match</h3>
            <div class="match-wrapper">
                <div class="team-title">
                    <div class="team-left" style="background-color: #3ad41e;">
                        <p1>TEAM 1</p1>
                    </div>
                    <div class="team-left"> 
                        <ul class="info-match">
                            <li>Player 1</li>
                            <li>Player 2</li>
                            <li>Player 3</li>
                        </ul>
                    </div>
                    <div class="team-left"  style="border:none">
                        <div class="input-group">
                            <button id="join" class="btn btn-join btn-join-left" type="submit" name="join" >Join</button>
                        </div>
                    </div>
                </div>
                
                <div class="vs"> VS </div>

                <div class="team-title">
                    <div class="team-right" style="background-color: #fba955;">
                        <p1>TEAM 2</p1>
                    </div>

                    <div class="team-right"> 
                        <ul class="info-match">
                            <li>Player 1</li>
                            <li>Player 2</li>
                            <li>Player 3</li>
                        </ul>
                    </div>

                    <div class="team-left" style="border:none">
                        <div class="input-group">
                            <button id="join" class="btn btn-join btn-join-right" type="submit" name="join" >Join</button>
                        </div>
                    </div>

                </div>

                <hr>
                <form method="post" action="action.php">
                    <div class="input-group">
                        <button class="btn-confirm" type="submit" value="Submit" >Confirm</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="column2">
            <h3>Match Info</h3>
            <div class="info-form">
                <ul class="info-match">
                    <li>Time: 7:30pm</li>
                    <li>Location: Chi Lang</li>
                    <li>Size: 10 people</li>
                </ul>
            </div>
        </div>
    </div>
  </div>
  
</body>
<script type="text/javascript" src="index.js"></script>

</html>