<?php

require_once("config.php");
require_once("userDetails.php");

define("MAXGAMES", 100);

if (!isset($_GET["steamids"])) {
  http_response_code(404);
  die("no steamids given");
}

$param = $_GET["steamids"];
$steamIDs = explode(",", $param);

if (count($steamIDs) == 0) {
  http_response_code(404);
  die("no steamids given");
}

$users = userDetailsForIDs($param);

$allGames = [];

for ($i = 0; $i < count($users); $i++) {
  $id = $users[$i]["steamid"];

  // remove unneeded data
  unset($users[$i]["communityvisibilitystate"]);
  unset($users[$i]["profilestate"]);
  unset($users[$i]["lastlogoff"]);
  unset($users[$i]["primaryclanid"]);
  unset($users[$i]["timecreated"]);
  unset($users[$i]["personastateflags"]);
  unset($users[$i]["loccountrycode"]);
  unset($users[$i]["personastate"]);

  $g = gamesForID($id);

  $allGames = array_merge($allGames, $g);

  $users[$i]["ownedGames"] = array_map(function($value) {
    return $value["appid"];
  }, $g);

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

$blacklist = json_decode(file_get_contents("lists/blacklist.json"));
$gameOccurrence = array_filter($gameOccurrence, function($key) use ($blacklist) {
  return !in_array($key, $blacklist);
}, ARRAY_FILTER_USE_KEY);

if (isset($_GET["singleplayer"]) && !$_GET["singleplayer"]) { // singleplayer=0 or singleplayer=1(default)
  $singleplayer = json_decode(file_get_contents("lists/singleplayer.json"));
  $gameOccurrence = array_filter($gameOccurrence, function($key) use ($singleplayer) {
    return !in_array($key, $singleplayer);
  }, ARRAY_FILTER_USE_KEY);
}

if (isset($_GET["freegames"]) && !$_GET["freegames"]) { // freegames=0 or freegames=1(default)
  $freegames = json_decode(file_get_contents("lists/freegames.json"));
  $gameOccurrence = array_filter($gameOccurrence, function($key) use ($freegames) {
    return !in_array($key, $freegames);
  }, ARRAY_FILTER_USE_KEY);
}

/*$gameOccurrence = array_filter($gameOccurrence, function($value){
  return $value > 1; // Filter games out that just one player owns.
});*/

$games = [];
$counter = 0;

foreach ($gameOccurrence as $key => $value) {
  $c = $value;
  $game = gameDetails($key, $allGames);
  $game["count"] = $c;
  $games[] = $game;
  if ($counter == MAXGAMES) {
    break;
  }
  $counter++;
}

// go through the user and mark games he does not own
for ($i = 0; $i < count($users); $i++) {
  $g = $games;
  foreach ($g as $key => &$value) {
    $value["owned"] = in_array($value["appid"], $users[$i]["ownedGames"]);
  }
  $users[$i]["games"] = $g;
  unset($users[$i]["ownedGames"]);
}

error_log(count($games));
die(json_encode($users));

function gamesForID($steamID) {
  global $apiKey;
  $folder = "cache/GetOwnedGames/";

  if (file_exists($folder . $steamID . ".json")) {
    $file = file_get_contents($folder . $steamID . ".json");
  } else {
    $opts = array('http' =>
      array(
        'user_agent' => 'SteamOverlap/1.0 (http://www.steamoverlap.com/)'
      )
    );
    $context = stream_context_create($opts);
    $url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . $apiKey . '&steamid=' . $steamID . '&include_appinfo=1&include_played_free_games=1&format=json';
    $file = @file_get_contents($url, FALSE, $context);
    if ($file === FALSE) {
      http_response_code(404);
      die("Error: User not found.");
    }
    file_put_contents($folder . $steamID . ".json", $file);
  }
  $json = json_decode($file, true);
  return $json["response"]["games"];
}

function gameDetails($appid, $allGames) {
  foreach ($allGames as $key => $value) {
    if ($value["appid"] == $appid) {
      return $value;
    }
  }
  return "";
}
