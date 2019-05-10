<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <title>Ranking</title>
</head>

<body>
  <?php include('../common/header.php'); ?>
  <div class="container">
    <div class="row">
      <div>
        <h2 style="display: inline;">List players in the world</h2>
        <span style="font-style:italic;">Order by elo</span>
        <select id="orderBy">
          <option value="DESC">Descending</option>
          <option value="ASC">Ascending</option>
        </select>
      </div>
      <ul class="list-group">
        <?php
        // Include dbConfig file
        require_once '../dbConfig.php';
        $orderBy = isset($_GET["orderBy"]) ? $_GET["orderBy"] : "DESC";

        // Attempt select query execution
        $sql = "SELECT player_id, name, elo FROM player ORDER BY elo $orderBy";
        if ($result = mysqli_query($link, $sql)) {
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              echo "<li class='list-group-item'>"
                . "<div>"
                . "<span style='font-style: italic;'>" . $row['player_id'] . "</span>"
                . " - "
                . "<span>" . $row['name'] . "</span>"
                . "</div>"
                . "<span class='badge'>" . $row['elo'] . "</span>"
                . "</li>";
            }
          }
        }
        ?>
      </ul>
    </div>
  </div>
  <script>
    // Update select options
    const urlParams = new URLSearchParams(window.location.search);
    const orderByValue = urlParams.get('orderBy') || 'DESC';

    const orderByElement = document.getElementById('orderBy');

    orderByElement.value = orderByValue;
    orderByElement.addEventListener('change', e => {
      window.location = "?orderBy=" + e.target.value;
    })
  </script>
</body>

</html>