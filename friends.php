<?php

require_once("config.php");
require_once("userDetails.php");

if (!isset($_GET["steamid"])) {
  http_response_code(404);
  die("no steamid given");
}

if (!is_numeric($_GET["steamid"])) {
  http_response_code(404);
  die("steamid not valid");
}

$friends = friendsForID($_GET["steamid"]);
$ids = array_map(function($value) {
  return $value["steamid"];
}, $friends);
$friends = userDetailsForIDs(implode(",", $ids));

// delete unused keys
$c = count($friends);
for ($i=0; $i < $c; $i++) {
  unset($friends[$i]["communityvisibilitystate"]);
  unset($friends[$i]["profilestate"]);
  unset($friends[$i]["lastlogoff"]);
  unset($friends[$i]["avatar"]);
  unset($friends[$i]["avatarfull"]);
  unset($friends[$i]["personastate"]);
  unset($friends[$i]["primaryclanid"]);
  unset($friends[$i]["timecreated"]);
  unset($friends[$i]["personastateflags"]);
  unset($friends[$i]["loccountrycode"]);
  unset($friends[$i]["gameid"]);
  unset($friends[$i]["gameextrainfo"]);
  unset($friends[$i]["locstatecode"]);
  unset($friends[$i]["realname"]);
  unset($friends[$i]["loccityid"]);
  unset($friends[$i]["commentpermission"]);
}

die(json_encode($friends));

function friendsForID($steamID) {
  global $apiKey;
  $folder = "cache/GetFriendList/";

  if (file_exists($folder . $steamID . ".json")) {
    $file = file_get_contents($folder . $steamID . ".json");
  } else {
    $opts = array('http' =>
      array(
        'user_agent' => 'SteamOverlap/1.0 (http://www.mysite.com/)'
      )
    );
    $context = stream_context_create($opts);
    $url = 'http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=' . $apiKey . '&steamid=' . $steamID . '&relationship=all&format=json';
    $file = @file_get_contents($url, FALSE, $context);
    if ($file === FALSE) {
      http_response_code(404);
      die("Error: User not found.");
    }
    file_put_contents($folder . $steamID . ".json", $file);
  }
  $json = json_decode($file, true);
  return $json["friendslist"]["friends"];
}
