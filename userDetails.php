<?php

function userDetailsForIDs($steamID) {
  $result = [];

  $folder = "cache/GetPlayerSummaries/";
  $ids = explode(",", $steamID);
  $count = count($ids);
  for ($i=0; $i < $count; $i++) {
    $id = $ids[$i];
    if (file_exists($folder . $id . ".json")) {
      $file = file_get_contents($folder . $id . ".json", FALSE);
      $result[] = json_decode($file, true);
      unset($ids[$i]);
    }
  }

  if (count($ids) == 0 ) { // if all are found in the cache go
    return $result;
  }

  // download the rest
  $steamID = implode(",", $ids);

  global $apiKey;
  $opts = array('http' =>
    array(
      'user_agent' => 'SteamOverlap/1.0 (http://www.mysite.com/)'
    )
  );
  $context = stream_context_create($opts);
  $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $apiKey . '&steamids=' . $steamID . '&format=json';
  $file = @file_get_contents($url, FALSE, $context);
  if ($file === FALSE) {
    http_response_code(404);
    die("Error: User not found.");
  }

  $json = json_decode($file, true);
  foreach ($json["response"]["players"] as $key => $value) {
    $result[] = $value;
    $id = $value["steamid"];
    file_put_contents($folder . $id . ".json", json_encode($value, JSON_PRETTY_PRINT));
  }
  return $result;
}
