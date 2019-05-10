<?php
setcookie("player_id", "", time()-3600*24*7, "/");
header("location:/matchup/home/");
?>