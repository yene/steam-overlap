<?php
class PlayerData {
  public $steamID;
  public $customURL;
  public $nick;
  public $games;

  public function __construct($pSteamID, $pGames) {
    $this->steamID = $pSteamID;
    $this->games = $pGames;
  }
}
