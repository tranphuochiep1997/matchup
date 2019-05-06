<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>HOME</title>
  <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
  <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>

    <?php  include('header.php'); ?>

    <div class="container">
    <div class="row">
        <div class="column1">
            <h3>List of Matches</h3>
            <?php
                // Include config file
                require_once "../dbConfig.php";
                
                // Attempt select query execution
                $sql = "SELECT * FROM matches";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='matches'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
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
                                    echo "<td>" . $row['id']        . "</td>";
                                    echo "<td>" . $row['title']     . "</td>";
                                    echo "<td>" . $row['startTime'] . "</td>";
                                    echo "<td>" . $row['size']      . "</td>";
                                    echo "<td>" . $row['loc']       . "</td>";
                                    echo "<td>";
                                        echo "<a href='detail.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'>Detail</a>";
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
                // mysqli_close($link);
                ?>
        </div>
        <div class="column2">
            <h3>Recent Matches</h3>
            <?php
                // Include config file
                // require_once "../dbConfig.php";
                
                // Attempt select query execution
                $sql = "SELECT * FROM matches";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='matches'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Team 1</th>";
                                    echo "<th>Score</th>";
                                    echo "<th>Team 2</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['id']        . "</td>";
                                    echo "<td>" . $row['title']     . "</td>";
                                    echo "<td>" . $row['startTime'] . "</td>";
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
    </div>
</body>
</html>