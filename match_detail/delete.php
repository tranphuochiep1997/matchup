<?php
if(isset($_GET["id"]) && !empty($_GET["id"])){
    require_once '../dbConfig.php';
    
    $matchId = $_GET["id"];
    $player_id = trim($_GET["playerId"]);
    $sql = "DELETE FROM detail WHERE player_id = '$player_id' AND match_id = '$matchId'";
    
    if($res = mysqli_query($link, $sql)){ 
        header("Location: index.php?id=".$matchId."&status=out");  
    } else {
        echo $sql;
    }

    mysqli_close($link);
} else{
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
}
?>