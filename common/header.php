<?php
echo '<div class="fixed-header">';
echo    '<nav>';
echo        '<a href="/matchup/home" style="float:left">MATCH MAKING</a>';
	        if (isset($_COOKIE["player_id"])){
				echo '<a href = "/matchup/auth/logout.php">Logout</a>';
				require_once "../dbConfig.php";
				$player_id = $_COOKIE["player_id"];
				$sql = "SELECT * FROM player where player_id = '$player_id'";
				$result = mysqli_query($link, $sql);
				$playerName = mysql_result($result,'name');				
				echo '<a>Welcome ' . $playerName . '</a>';
			}
			else {
				echo '<a href = "/matchup/auth/login.php">Login</a>';
			}
			
echo        '<a href="/matchup/form-create-match">Create Match</a>';
echo        '<a href="#">My Matches</a>';
echo        '<a href="/matchup/ranking">Ranking</a>';
echo    '</nav>';
echo '</div>';
?>