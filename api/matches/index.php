<?php
header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: text/xml");

require_once "../../dbConfig.php";

date_default_timezone_set('Asia/Ho_Chi_Minh');

$beforeOneHour = date("Y-m-d H:i:s", time() - (60 * 60));

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = 5;
$offset = ((int)$page - 1) * $limit;
$sql = "SELECT * FROM matches where startTime < '$beforeOneHour' limit $limit offset $offset";

// $response = array();
// $response["data"] = array();

$responseXML = new SimpleXMLElement("<matches></matches>");

if($result = mysqli_query($link, $sql)){
  while($row = mysqli_fetch_array($result)) {
    // $match = array(
    //   "match_id" => $row["match_id"],
    //   "title" => $row["title"],
    //   "kind" => $row["kind"],
    //   "startTime" => $row["startTime"],
    //   "scoreA" => $row["scoreA"],
    //   "scoreB" => $row["scoreB"],
    //   "status" => $row["status"],
    //   "loc" => $row["loc"],
    //   "player_id" => $row["player_id"]
    // );

    // array_push($response["data"], $match);

    $matchItem = $responseXML->addChild("match");
    $matchItem->addChild("match_id", $row["match_id"]);
    $matchItem->addChild("title", $row["title"]);
    $matchItem->addChild("kind", $row["kind"]);
    $matchItem->addChild("startTime", $row["startTime"]);
    $matchItem->addChild("scoreA", $row["scoreA"]);
    $matchItem->addChild("scoreB", $row["scoreB"]);
    $matchItem->addChild("status", $row["status"]);
    $matchItem->addChild("loc", $row["loc"]);
    $matchItem->addChild("player_id", $row["player_id"]);
  }
}

// echo json_encode($response);
echo $responseXML->asXML();
?>