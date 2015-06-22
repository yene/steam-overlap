<?php

require_once("config.php");
require_once("PlayerData.php");

$blacklist = [223530, 205790, 367540, 2430, 232210];

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
$gameOccurrence = array_filter($gameOccurrence, function($value){
  return $value > 1; // Filter games out that just one player owns.
});
$gameOccurrence = array_filter($gameOccurrence, function($key) use ($blacklist) {
  return !in_array($key, $blacklist);
}, ARRAY_FILTER_USE_KEY);

$games = array();

foreach ($gameOccurrence as $key => $value) {
  $c = $value;
  $game = gameDetailsForID($key);
  $game["count"] = $c;
  $games[] = $game;
}

die(json_encode($games));

function gamesForPlayerID($playerID) {
  global $apiKey;

  if (file_exists($playerID . ".json")) {
    $file = file_get_contents($playerID . ".json", FALSE);
  } else {
    $opts = array('http' =>
      array(
        'user_agent' => 'SteamOverlap/1.0 (http://www.mysite.com/)'
      )
    );
    $context = stream_context_create($opts);
    $url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . $apiKey . '&steamid=' . $playerID . '&include_appinfo=1&include_played_free_games=1&format=json';
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
          "appid" => $gameID,
          "name" => $game["name"],
          "img_icon_url" => $game["img_icon_url"],
          "img_logo_url" => $game["img_logo_url"],
      );
    }
  }
  return array();
}
