<?php
if(isset($_GET["id"]) && !empty($_GET["id"])){
    require_once '../dbConfig.php';
    
    $sql = "DELETE FROM detail WHERE player_id = ?";
    $matchId = $_GET["id"];
    
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["playerId"]);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: index.php?id=".$matchId."&status=out");
            exit();
        } else{
            header("Location: index.php?id=".$matchId."&status=error");
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>