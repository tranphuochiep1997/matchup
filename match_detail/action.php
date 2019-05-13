<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    require_once '../dbConfig.php';

    $team = mysqli_real_escape_string($link, $_POST['team']);
    $match_id = mysqli_real_escape_string($link, $_POST['id']);
    $session = !isset($_COOKIE["player_id"]) ? null : $_COOKIE["player_id"];

    $sql  = "INSERT INTO detail(team, player_id, match_id) VALUES('$team', '$session', '$match_id');";
    $sql .= "UPDATE matches as m INNER join (select count(*) as count, match_id from detail WHERE match_id = '$match_id') tt
             ON m.match_id = tt.match_id SET m.status = 2 WHERE m.kind <= tt.count";

    if (mysqli_multi_query($link, $sql)) {
        header('Location: /matchup/match_detail/index.php?id='.$match_id.'&status=true');
    } else {
        // echo $sql;
        header('Location: /matchup/match_detail/index.php?id='.$match_id.'&status=false');
    }
    // Close connection
    mysqli_close($link);
    }

?>