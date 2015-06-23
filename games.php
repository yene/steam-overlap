<?php

require_once("config.php");

if (!isset($_GET["steamid"]) && !is_numeric($_GET["steamid"])) {
  die("no steamid given");
}

$games = gamesForPlayerID($_GET["steamid"]);

$blacklist = json_decode(file_get_contents("blacklist.json"));
$games = array_filter($games, function($value) use ($blacklist) {
  return !in_array($value["appid"], $blacklist);
});

if (isset($_GET["singleplayer"]) && !$_GET["singleplayer"]) { // singleplayer=0 or singleplayer=1
  $singleplayer = json_decode(file_get_contents("singleplayer.json"));
  $games = array_filter($games, function($value) use ($singleplayer) {
    return !in_array($value["appid"], $singleplayer);
  });
}

if (isset($_GET["freegames"]) && !$_GET["freegames"]) { // freegames=0 or freegames=1
  $freegames = json_decode(file_get_contents("freegames.json"));
  $games = array_filter($games, function($value) use ($freegames) {
    return !in_array($value["appid"], $freegames);
  });
}

if (isset($_GET["played"]) && $_GET["played"]) { // played=0 or played=1
  $games = array_filter($games, function($value) {
    return $value["playtime_forever"] > 0;
  });
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
