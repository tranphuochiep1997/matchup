<?php
header("Content-Type: text/xml");
// header("Content-Type: text/html");
require_once "../dbConfig.php";

$player_id = $_COOKIE["player_id"];
$sql = "SELECT m.match_id, m.startTime, m.kind, m.title, m.loc, m.scoreA, m.scoreB, d.team, m.status 
FROM matches m, detail d where m.match_id = d.match_id and d.player_id = '$player_id'";

$responseXML = new DOMDocument("1.0");
$responseXML->appendChild($responseXML->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="xsl.xsl"'));
$xml_matches = $responseXML->createElement("matches");
if($result = mysqli_query($link, $sql)){
  while($row = mysqli_fetch_array($result)) {
    $xml_match = $responseXML->createElement("match");
    $xml_matches->appendChild($xml_match);
    
    $xml_match_id = $responseXML->createElement("match_id",$row["match_id"]);
    $att = $responseXML->createAttribute("id");
    $att->value = $row["match_id"];
    $xml_match->appendChild($att);
    
    $xml_match->appendChild($xml_match_id);

    $xml_title = $responseXML->createElement("title",$row["title"]);
    $xml_match->appendChild($xml_title);

    $xml_kind = $responseXML->createElement("kind",$row["kind"]);
    $xml_match->appendChild($xml_kind);

    $xml_start_time = $responseXML->createElement("startTime",$row["startTime"]);
    $xml_match->appendChild($xml_start_time);

    $xml_loc = $responseXML->createElement("location",$row["loc"]);
    $xml_match->appendChild($xml_loc);

    $xml_scoreA = $responseXML->createElement("scoreA",$row["scoreA"]);
    $xml_match->appendChild($xml_scoreA);

    $xml_scoreB = $responseXML->createElement("scoreB",$row["scoreB"]);
    $xml_match->appendChild($xml_scoreB);

    $xml_team = $responseXML->createElement("team",$row["team"]);
    $xml_match->appendChild($xml_team);
  }
}
$responseXML->appendChild($xml_matches);

echo $responseXML->saveXML();
?>