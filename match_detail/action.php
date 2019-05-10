<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    require_once '../dbConfig.php';

    $team = mysqli_real_escape_string($link, $_POST['team']);
    $match_id = mysqli_real_escape_string($link, $_POST['id']);
    $session = !isset($_COOKIE["player_id"]) ? null : $_COOKIE["player_id"];

    $sql = "INSERT INTO detail(team, player_id, match_id) VALUES('$team', '$session', '$match_id')";

    if (mysqli_query($link, $sql)) {
        header('Location: /matchup/match_detail/index.php?id='.$match_id.'&status=true');
    } else {
        // exit();
        header('Location: /matchup/match_detail/index.php?id='.$match_id.'&status=false');
    }
    // Close connection
    mysqli_close($link);
    }

?>