<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>HOME</title>
  <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <script src="../common/callApi.js"></script>
</head>
<body>

    <?php include('../common/header.php'); ?>

    <div class="container">
    <div class="row">
        <div class="column1">
            <h3>List of Matches</h3>
            <?php
                // Include config file
                require_once "../dbConfig.php";

                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $curtime = date('Y-m-d H:i:s');
                $sql = "SELECT * FROM matches WHERE startTime > '$curtime' ORDER BY startTime ASC LIMIT 15";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='matches'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Code</th>";
                                    echo "<th>Title</th>";
                                    echo "<th>Time</th>";
                                    echo "<th>Size</th>";
                                    echo "<th>Location</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['match_id']  . "</td>";
                                    echo "<td>" . $row['title']     . "</td>";
                                    echo "<td>" . $row['startTime'] . "</td>";
                                    echo "<td>" . $row['kind']      . "</td>";
                                    echo "<td>" . $row['loc']       . "</td>";
                                    echo "<td>";
                                        echo "<a href='/matchup/match_detail/index.php?id=". $row['match_id'] ."' title='View Record' data-toggle='tooltip'>Detail</a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

                // Close connection
                mysqli_close($link);
                ?>
        </div>
        <div class="column2">
            <h3>Recent Matches</h3>
            <table class="matches">
                <tbody id="recent-matches-body"></tbody>
            </table>
            <button id='loadMore' class='btn' style='padding:3px; margin: 2px; float: right;' type='submit' value='Submit' >See more</button>
            <?php
                // Include config file
                // require_once "../dbConfig.php";
                
                // $sql = "SELECT * FROM matches WHERE startTime < '$curtime' AND status = 1 LIMIT 5";
                // if($result = mysqli_query($link, $sql)){
                //     if(mysqli_num_rows($result) > 0){
                //         echo "<table id='withAjax' class='matches'>";
                //             echo "<tbody>";
                //             while($row = mysqli_fetch_array($result)){
                //                 echo "<tr>";
                //                     echo "<td><a href='/matchup/match_detail/index.php?id=".$row['match_id']."&readOnly=true'>" . $row['title']  . "</a></td>";
                //                     echo "<td class='line'>" . $row['startTime'] . "</td>";
                //                 echo "</tr>";
                //             }
                //             echo "</tbody>";                            
                //         echo "</table>";
                //         // Free result set
                //         mysqli_free_result($result);
                //     } else{
                //         echo "<p class='lead'><em>No records were found.</em></p>";
                //     }
                //     echo "<button id='loadMore' class='btn' style='padding:3px; margin: 2px; float: right;' type='submit' value='Submit' >See more</button>";
                // } else{
                //     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                // }

                // // Close connection
                // mysqli_close($link);
                ?>
        </div>
    </div>

    <script type="text/javascript" src="index.js"></script>
</body>
</html>