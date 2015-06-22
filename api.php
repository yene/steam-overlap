<?php

require_once("config.php");
require_once("PlayerData.php");

$yene = "76561197964515697";
$shadow = "76561198005110125";
$blacky = "76561197994273896";

$users = array();

$users[] = new PlayerData($yene, gamesForPlayerID($yene));
$users[] = new PlayerData($shadow, gamesForPlayerID($shadow));
$users[] = new PlayerData($blacky, gamesForPlayerID($blacky));

$allGames = array();
foreach ($users as $user) {
  $allGames = array_merge($allGames, $user->games);
}
$listOfGames = array_map(function($value) {
    return $value["appid"];
}, $allGames);
$gameOccurrence = array_reduce($listOfGames, function($carry, $item) {
  if (array_key_exists($item, $carry)) {
    $carry[$item]++;
  } else {
    $carry[$item] = 1;
  }
  return $carry;
}, array());
arsort($gameOccurrence);
$gameOccurrence = array_filter($gameOccurrence, function($var){
  return $var > 1; // Filter games out that just one player owns.
});

foreach ($gameOccurrence as $key => &$game) {
  $c = $game;
  $game = gameDetailsForID($key);
  $game["count"] = $c;
}

echo "<pre>";
var_dump($gameOccurrence);


$opts = array('http' =>
  array(
    'user_agent' => 'SteamOverlap/1.0 (http://www.mysite.com/)'
  )
);
$context = stream_context_create($opts);


function gamesForPlayerID($playerID) {
  global $apiKey, $context;

  if (file_exists($playerID . ".json")) {
    $file = file_get_contents($playerID . ".json", FALSE);
  } else {
    $url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . $apiKey . '&steamid=' . $playerID . '&include_appinfo=1&include_played_free_games=1&format=json';
    echo $url;
    $file = file_get_contents($url, FALSE, $context);
  }
  $json = json_decode($file, true);
  return $json["response"]["games"];
}

function gameDetailsForID($gameID) {
  global $allGames;
  foreach ($allGames as $game) {
    if ($game["appid"] === $gameID) {
      return array(
          "name" => $game["name"],
          "img_icon_url" => $game["img_icon_url"],
          "img_logo_url" => $game["img_logo_url"],
      );
    }
  }
  return array();
}
