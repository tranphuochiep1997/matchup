<div class="header-nav">
<label for="show-menu" class="show-menu"><img src="../images/icon.png" style="width: 13px;"><span style="padding: 5px">Menu</span></label>
<input type="checkbox" id="show-menu" role="button">
<ul id="menu">
<li style="float:left"><a class="home" href="/matchup/home" >MATCH MAKING</a></li>
	 <?php       if (isset($_COOKIE["player_id"])){
				echo '<li><a href = "/matchup/auth/logout.php">Logout</a></li>';
				require_once "../dbConfig.php";
				$player_id = $_COOKIE["player_id"];
				$sql = "SELECT p.name FROM player p where p.player_id = '$player_id'";
				$result = mysqli_query($link, $sql);
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result)){ 
						echo '<li class="user"><a>Welcome ' . $row['name'] . '</a></li>';
					}
				}			
				
			}
			else {
				echo '<li><a href = "/matchup/auth/login.php">Login</a></li>';
			}
			
		echo '<li><a href="/matchup/form-create-match">Create Match</a></li>';
		if (isset($_COOKIE["player_id"])){
			echo '<li><a href="/matchup/my-matches/">My Matches</a></li>';
		}
		echo '<li><a href="/matchup/ranking">Ranking</a></li>';
		?>
    </ul>
 </div>