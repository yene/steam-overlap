<?php

$opts = array('http' =>
  array(
    'user_agent' => 'SteamOverlap/1.0 (http://www.mysite.com/)'
  )
);
$context = stream_context_create($opts);
$allGamesURL = "http://api.steampowered.com/ISteamApps/GetAppList/v0001/";
//$file = file_get_contents($allGamesURL, FALSE, $context);
$file = file_get_contents("all.json", FALSE);
$json = json_decode($file, true);
$allGames = $json["applist"]["apps"]["app"];

$singleplayer = array();
$blacklist = array();
$multiplayer = array();

for ($i=0; $i < count($allGames); $i++) {
  if ($i % 10 == 0 ) {
    file_put_contents("blacklist.json", json_encode($blacklist, JSON_PRETTY_PRINT));
    file_put_contents("singleplayer.json", json_encode($singleplayer, JSON_PRETTY_PRINT));
    file_put_contents("multiplayer.json", json_encode($multiplayer, JSON_PRETTY_PRINT));
    echo "saving \n";
  }

  sleep(1); // wait or we get blocked by the steam servers

  $game = $allGames[$i];
  $appid = $game["appid"];
  echo " $i checking: " . $game["name"] . "($appid)";
  $url = "http://store.steampowered.com/api/appdetails?appids=" . $appid;
  $file = file_get_contents($url, FALSE, $context);
  $json = json_decode($file, true);

  if (!$json[$appid]["success"]) { // no result (Betas and Servers)
    $blacklist[] = $appid;
    echo " -> blacklist \n";
    continue;
  }

  if ($json[$appid]["data"]["type"] != "game") { // if not game (dlc or such)
    $blacklist[] = $appid;
    echo " -> blacklist \n";
    continue;
  }

  if (!isset($json[$appid]["data"]["categories"])) { // no categories
    $blacklist[] = $appid;
    echo " -> blacklist \n";
    continue;
  }

  $categories = $json[$appid]["data"]["categories"];
  $categoriesIDs = array_map(function($value) {
      return $value["id"];
  }, $categories);

  if ( in_array(10, $categoriesIDs) ) { // check if demo category
    $blacklist[] = $appid;
    echo " -> blacklist \n";
    continue;
  }

  if ( in_array(2, $categoriesIDs) && !in_array(1, $categoriesIDs)) { // if game is singleplayer (2) but not multiplayer (1)
    $singleplayer[] = $appid;
    echo " -> singleplayer only \n";
    continue;
  }

  $multiplayer[] = $appid;
  echo " -> multiplayer \n";
}

file_put_contents("blacklist.json", json_encode($blacklist, JSON_PRETTY_PRINT));
file_put_contents("singleplayer.json", json_encode($singleplayer, JSON_PRETTY_PRINT));
file_put_contents("multiplayer.json", json_encode($multiplayer, JSON_PRETTY_PRINT));
echo "finished \n";
