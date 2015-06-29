<?php

if (!isset($_GET["id"])) {
  http_response_code(404);
  die("no id given");
}

die(json_encode(steamIDforCustomID($_GET["id"])));

function steamIDforCustomID($id) {
  $opts = array('http' =>
    array(
      'user_agent' => 'SteamOverlap/1.0 (http://www.steamoverlap.com/)'
    )
  );
  $context = stream_context_create($opts);
  $url = 'http://steamcommunity.com/id/' . $id . '?xml=1';
  $file = @file_get_contents($url, FALSE, $context);
  if ($file === FALSE) {
    http_response_code(404);
    die("Error: User not found.");
  }

  $xml = simplexml_load_string($file);
  return $xml->steamID64;
}
