<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once '../dbConfig.php';
    // $message = "<p style='display:none'></p>";
    $sql = "SELECT * FROM matches WHERE match_id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $match_id = $row["match_id"];
                $title = $row["title"];
                $startTime = $row["startTime"];
                $status = $row["status"];
                $kind = $row["kind"];
                $loc = $row["loc"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    mysqli_stmt_close($stmt);
    // mysqli_close($link);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    require_once '../dbConfig.php';

    $team = $_POST["idTeam"];
    $match_id = $_GET["id"];

    $sql = "INSERT INTO detail(team, player_id, match_id) VALUES('$team', 'htran', '$match_id')";

    if (mysqli_query($link, $sql)) {
        $message='<div class="message-success">Welcome to the match. Kindly Enjoy it</div>';
    } else {
        $message='<div class="message-error">You are in game already!!</div>';
    //   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    // Close connection
    mysqli_close($link);
    }

?>

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
                        <ul id="team-left" class="info-match">
                            <li>L. Messi</li>
                        </ul>
                    </div>
                    <div class="team-left"  style="border:none">
                        <div class="input-group">
                            <button id="join-left" class="btn btn-join btn-join-left" type="submit" name="join" >Join</button>
                        </div>
                    </div>
                </div>
                
                <div class="vs"> VS </div>

                <div class="team-title">
                    <div class="team-right" style="background-color: #fba955;">
                        <p1>TEAM 2</p1>
                    </div>

                    <div class="team-right"> 
                        <ul id="team-right" class="info-match">
                            <li>Neymar Jr</li>
                        </ul>
                    </div>

                    <div class="team-right" style="border:none">
                        <div class="input-group">
                            <button id="join-right" class="btn btn-join btn-join-right" type="submit" name="join" >Join</button>
                        </div>
                    </div>

                </div>

                <hr>
                <form method="post" action="index.php?id=<?php echo $param_id; ?>">
                    <input id="idTeam" type="hidden" name="team" value="1"/>
                    <div class="input-group">
                        <button class="btn-confirm" type="submit" value="Submit" >Confirm</button>
                    </div>
                    <div class="input-group ">
                        <?php 
                            if(isset($_GET["id"]) && isset($message)) {
                                echo $message;
                            }
                        ?>
                     </div>
                </form>
            </div>
        </div>
        <div class="column2">
            <h3>Match Info</h3>
            <div class="info-form">
                <ul class="info-match">
                    <li>Match Code: <?php echo $match_id; ?></li>
                    <li>Title: <?php echo $title; ?></li>
                    <li>Start Time: <?php echo $startTime; ?></li>
                    <li>Type: <?php echo $kind; ?></li>
                    <li>Status: <?php echo $status; ?></li>
                    <li>Location: <?php echo $loc; ?></li>
                </ul>
            </div>
        </div>
    </div>
  </div>
  
</body>
<script type="text/javascript" src="index.js"></script>

</html>