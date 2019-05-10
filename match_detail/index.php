<?php
require_once '../dbConfig.php';
$session = !isset($_COOKIE["player_id"]) ? null : $_COOKIE["player_id"];

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $sql = "SELECT m.match_id, m.title, m.startTime, m.status, m.kind, m.loc, p.name FROM matches m, player p WHERE m.player_id = p.player_id and match_id = ?";

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
                $curname = $row["name"];
            } else{
                header("location: /matchup/home/");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    $sql = "SELECT * FROM detail WHERE player_id = '$session' AND match_id = '$param_id'";
    if($res = mysqli_query($link, $sql)){ 
        if(mysqli_num_rows($res) > 0){ 
            $isExist = 'exist';
        }
        else {
        }
        mysqli_free_result($res);
    }
    else {
        echo "Error";
    }
     
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail</title>
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
</head>

<body>
  <?php  include('../common/header.php'); ?>
  <div class="container">
    <div class="row">
        <?php 
            if (!isset($_COOKIE["player_id"]) && !isset($_GET["readOnly"])) {
                echo "<div class='alert alert-danger'>  Please login to participate in the match</div>";
            }
        ?>
        <div class="column1">
            <?php 
                if(!isset($_GET["readOnly"])) {
                    echo '<h3>Participate in the match</h3>';
                }
                else echo '<h3>Match history</h3>';
            ?>
            
            <div class="match-wrapper">
                <div class="team-title">
                    <div class="team-left" style="background-color: #3ad41e;">
                        <p1>TEAM 1</p1>
                    </div>
                    <div class="team-left"> 
                        <ul id="team-left" class="info-match">
                        <?php 
                            $matchId = $_GET["id"];
                            $sql = "SELECT d.team, p.name, p.player_id from detail d, player p WHERE d.player_id = p.player_id AND d.match_id = '$matchId' GROUP BY p.player_id";
                            if($result = mysqli_query($link, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while ($row = mysqli_fetch_array($result)) {
                                        if($row["team"] === '1')
                                            echo "<li>".$row["name"]."</li>";
                                    }
                                }
                            }
                            else {
                                header("Location: error.php");
                            }
                            $sql_player = "SELECT * FROM player WHERE player_id = '$session'";
                            if($res = mysqli_query($link, $sql_player)){ 
                                if(mysqli_num_rows($res) > 0){ 
                                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                                    $player_name = $row["name"];
                                    if(!isset($_GET["readOnly"])) {
                                        if(!isset($isExist) && !isset($_GET["status"])) {
                                            echo '<li id="new">'.$player_name.'</li>';
                                        }
                                    }
                                }
                                mysqli_free_result($res);
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                
                <div class="vs"> 
                    <div>VS</div>
                    <div class="team-left"  style="border:none; <?php echo isset($_GET["readOnly"]) ? 'display: none': ''?>">
                        <div class="input-group">
                            <button id="join" class="btn btn-join" type="submit" name="join" <?php echo isset($isExist) || !isset($session) ? "disabled" : "" ?>>&#x2194;</button>
                        </div>
                    </div>
                </div>

                <div class="team-title">
                    <div class="team-right" style="background-color: #fba955;">
                        <p1>TEAM 2</p1>
                    </div>

                    <div class="team-right"> 
                        <ul id="team-right" class="info-match">
                            <?php 
                               if($result = mysqli_query($link, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_array($result)) {
                                            if($row["team"] === '2')
                                                echo "<li>".$row["name"]."</li>";
                                        }
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <hr>
                <form method="post" action="action.php">
                    <input id="idTeam" type="hidden" name="team" value="1"/>
                    <input id="username" type="hidden" name="username" value="<?php echo !isset($player_name) ? '' : $player_name ?>" />
                    <input type="hidden" name="id" value="<?php echo $_GET["id"];?>"/>
                    <div class="input-group <?php echo !empty($isExist) ? 'hide' : ''; ?>" style="<?php echo isset($_GET["readOnly"]) ? 'display: none': ''?>">
                        <button class="btn-confirm" type="submit" value="Submit" <?php echo !isset($session) ? "disabled" : "" ?> >Confirm</button>
                    </div>
                    <div class="input-group <?php echo empty($isExist) ? 'hide' : ''; ?>" style="<?php echo isset($_GET["readOnly"]) ? 'display: none': ''?>">
                        <a class="btn-cancel" href="delete.php?id=<?php echo $_GET["id"];?>&playerId=<?php echo $session;?>">Cancel</a>
                    </div>
                    <div class="input-group ">
                        <?php 
                            if(isset($_GET["status"])) {
                                if($_GET["status"]==='true')
                                    echo '<p class="message-success">You are in game now. Kindly enjoy it :)</p>';
                                else if($_GET["status"]==='out')
                                    echo '<p class="message-success">You have left the game. Pretty regretful :(</p>';
                                else echo '<p class="message-error">Something went wrong</p>';
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
                    <li>Title: <?php echo $title; ?></li>
                    <li>Creator: <?php echo $curname ?></li>
                    <li>Match Code: <?php echo $match_id; ?></li>
                    <li>Start Time: <?php echo $startTime; ?></li>
                    <li>Type: <?php echo $kind; ?></li>
                    <li>Status: <?php echo $status; ?></li>
                    <li>Location: <?php echo $loc; ?></li>
                </ul>
            </div>
        </div>
    </div>
  </div>
  <script type="text/javascript" src="index.js"></script>
</body>
</html>