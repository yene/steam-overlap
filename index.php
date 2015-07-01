<?php
require_once "SteamSignIn.php";
$steam_login_verify = SteamSignIn::validate();
if (!empty($steam_login_verify)) {
  $server = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
  header("Location: " . $server . "?ids=" . $steam_login_verify);
  die();
}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Steam Overlap</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body><!--
    <div class="row">
      <div class="large-12 columns">
        <h1>Welcome to Steam Overlap</h1>
      </div>
    </div>-->

    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <h3>Welcome to Steam Overlap</h3>
	        <p>Find out which Steam games you have in common with your friends.</p>
          <!--
          <form>
            <div class="row">
              <div class="small-8 columns">
                <input id="checkbox1" type="checkbox"><label for="checkbox1">Show Singleplayer</label>
                <input id="checkbox2" type="checkbox"><label for="checkbox2">Hide games nobody played.</label>
              </div>
            </div>
          </form>
          -->
      	</div>
      </div>
    </div>

    <div class="row">
      <div class="large-12 medium-12 columns">
        <div class="row js-games">
          <div class="large-3 medium-3 small-3 columns">
            <div class="callout panel games disable-list">
              <a href="" class="button btn-add" data-index="0">Add Yourself</a>
              <ul class="games-list">
                <li id="0"><a class="disabled-game" title="Left 4 Dead 2" href="http://store.steampowered.com/app/550/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/550/205863cc21e751a576d6fff851984b3170684142.jpg);"></a></li>
                <li id="1"><a class="disabled-game" title="Counter-Strike: Source" href="http://store.steampowered.com/app/240/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/240/ee97d0dbf3e5d5d59e69dc20b98ed9dc8cad5283.jpg);"></a></li>
                <li id="2"><a class="disabled-game" title="Dungeon Defenders" href="http://store.steampowered.com/app/65800/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/65800/71af270cff61ab197f9932212012134a436d9682.jpg);"></a></li>
                <li id="4"><a class="disabled-game" title="Half-Life 2: Deathmatch" href="http://store.steampowered.com/app/320/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/320/6dd9f66771300f2252d411e50739a1ceae9e5b30.jpg);"></a></li>
                <li id="5"><a class="disabled-game" title="Counter-Strike" href="http://store.steampowered.com/app/10/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10/af890f848dd606ac2fd4415de3c3f5e7a66fcb9f.jpg);"></a></li>
                <li id="6"><a class="disabled-game" title="Left 4 Dead" href="http://store.steampowered.com/app/500/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/500/0f67ee504d8f04ecd83986dd7855821dc21f7a78.jpg);"></a></li>
                <li id="7"><a class="disabled-game" title="Counter-Strike: Global Offensive" href="http://store.steampowered.com/app/730/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/730/d0595ff02f5c79fd19b06f4d6165c3fda2372820.jpg);"></a></li>
                <li id="8"><a class="disabled-game" title="The Ship" href="http://store.steampowered.com/app/2400/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/2400/2b19a255140350735cf8461f6e893452e1eae95e.jpg);"></a></li>
                <li id="9"><a class="disabled-game" title="Call of Duty: Modern Warfare 2 - Multiplayer" href="http://store.steampowered.com/app/10190/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10190/070cad064b3a81d6ede0f6054d9eb763004a07e0.jpg);"></a></li>
                <li id="10"><a class="disabled-game" title="Call of Duty: Modern Warfare 2" href="http://store.steampowered.com/app/10180/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10180/82de30354cb5ee352609c47ea47b86797008e436.jpg);"></a></li>
                <li id="11"><a class="disabled-game" title="Magicka" href="http://store.steampowered.com/app/42910/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/42910/8c59c674ef40f59c3bafde8ff0d59b7994c66477.jpg);"></a></li>
                <li id="12"><a class="disabled-game" title="Killing Floor" href="http://store.steampowered.com/app/1250/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/1250/354c07a75cc16f6bf551b81d27f4eee3436fc2fb.jpg);"></a></li>
                <li id="13"><a class="disabled-game" title="Dead Island" href="http://store.steampowered.com/app/91310/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/91310/62632a275a4cc08f0238ed3d589ce1d8627fde91.jpg);"></a></li>
                <li id="14"><a class="disabled-game" title="Rome: Total War" href="http://store.steampowered.com/app/4760/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4760/134817933edf4f8d0665d456889c0315c416fff2.jpg);"></a></li>
                <li id="15"><a class="disabled-game" title="Medieval II: Total War" href="http://store.steampowered.com/app/4700/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4700/fcd1abd6380998e473b92690e28a9fe0a1a27b8d.jpg);"></a></li>
                <li id="16"><a class="disabled-game" title="Total War: SHOGUN 2" href="http://store.steampowered.com/app/34330/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/34330/c6f6e87e742a2e40689486423e8320bd318e3ec7.jpg);"></a></li>
              </ul>
            </div>
          </div>
          <div class="large-3 medium-3 small-3 columns js-template">
            <div class="callout panel games disable-list disable-button">
              <a href="" class="button btn-add" data-index="1">Add a Friend</a>
              <ul class="games-list">
                <li id="0"><a class="disabled-game" title="Left 4 Dead 2" href="http://store.steampowered.com/app/550/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/550/205863cc21e751a576d6fff851984b3170684142.jpg);"></a></li>
                <li id="1"><a class="disabled-game" title="Counter-Strike: Source" href="http://store.steampowered.com/app/240/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/240/ee97d0dbf3e5d5d59e69dc20b98ed9dc8cad5283.jpg);"></a></li>
                <li id="2"><a class="disabled-game" title="Dungeon Defenders" href="http://store.steampowered.com/app/65800/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/65800/71af270cff61ab197f9932212012134a436d9682.jpg);"></a></li>
                <li id="4"><a class="disabled-game" title="Half-Life 2: Deathmatch" href="http://store.steampowered.com/app/320/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/320/6dd9f66771300f2252d411e50739a1ceae9e5b30.jpg);"></a></li>
                <li id="5"><a class="disabled-game" title="Counter-Strike" href="http://store.steampowered.com/app/10/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10/af890f848dd606ac2fd4415de3c3f5e7a66fcb9f.jpg);"></a></li>
                <li id="6"><a class="disabled-game" title="Left 4 Dead" href="http://store.steampowered.com/app/500/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/500/0f67ee504d8f04ecd83986dd7855821dc21f7a78.jpg);"></a></li>
                <li id="7"><a class="disabled-game" title="Counter-Strike: Global Offensive" href="http://store.steampowered.com/app/730/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/730/d0595ff02f5c79fd19b06f4d6165c3fda2372820.jpg);"></a></li>
                <li id="8"><a class="disabled-game" title="The Ship" href="http://store.steampowered.com/app/2400/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/2400/2b19a255140350735cf8461f6e893452e1eae95e.jpg);"></a></li>
                <li id="9"><a class="disabled-game" title="Call of Duty: Modern Warfare 2 - Multiplayer" href="http://store.steampowered.com/app/10190/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10190/070cad064b3a81d6ede0f6054d9eb763004a07e0.jpg);"></a></li>
                <li id="10"><a class="disabled-game" title="Call of Duty: Modern Warfare 2" href="http://store.steampowered.com/app/10180/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10180/82de30354cb5ee352609c47ea47b86797008e436.jpg);"></a></li>
                <li id="11"><a class="disabled-game" title="Magicka" href="http://store.steampowered.com/app/42910/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/42910/8c59c674ef40f59c3bafde8ff0d59b7994c66477.jpg);"></a></li>
                <li id="12"><a class="disabled-game" title="Killing Floor" href="http://store.steampowered.com/app/1250/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/1250/354c07a75cc16f6bf551b81d27f4eee3436fc2fb.jpg);"></a></li>
                <li id="13"><a class="disabled-game" title="Dead Island" href="http://store.steampowered.com/app/91310/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/91310/62632a275a4cc08f0238ed3d589ce1d8627fde91.jpg);"></a></li>
                <li id="14"><a class="disabled-game" title="Rome: Total War" href="http://store.steampowered.com/app/4760/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4760/134817933edf4f8d0665d456889c0315c416fff2.jpg);"></a></li>
                <li id="15"><a class="disabled-game" title="Medieval II: Total War" href="http://store.steampowered.com/app/4700/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4700/fcd1abd6380998e473b92690e28a9fe0a1a27b8d.jpg);"></a></li>
                <li id="16"><a class="disabled-game" title="Total War: SHOGUN 2" href="http://store.steampowered.com/app/34330/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/34330/c6f6e87e742a2e40689486423e8320bd318e3ec7.jpg);"></a></li>
              </ul>
            </div>
          </div>
          <div class="large-3 medium-3 small-3 columns">
            <div class="callout panel games disable-list disable-button">
              <a href="" class="button btn-add" data-index="2">Add a Friend</a>
              <ul class="games-list">
                <li id="0"><a class="disabled-game" title="Left 4 Dead 2" href="http://store.steampowered.com/app/550/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/550/205863cc21e751a576d6fff851984b3170684142.jpg);"></a></li>
                <li id="1"><a class="disabled-game" title="Counter-Strike: Source" href="http://store.steampowered.com/app/240/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/240/ee97d0dbf3e5d5d59e69dc20b98ed9dc8cad5283.jpg);"></a></li>
                <li id="2"><a class="disabled-game" title="Dungeon Defenders" href="http://store.steampowered.com/app/65800/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/65800/71af270cff61ab197f9932212012134a436d9682.jpg);"></a></li>
                <li id="4"><a class="disabled-game" title="Half-Life 2: Deathmatch" href="http://store.steampowered.com/app/320/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/320/6dd9f66771300f2252d411e50739a1ceae9e5b30.jpg);"></a></li>
                <li id="5"><a class="disabled-game" title="Counter-Strike" href="http://store.steampowered.com/app/10/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10/af890f848dd606ac2fd4415de3c3f5e7a66fcb9f.jpg);"></a></li>
                <li id="6"><a class="disabled-game" title="Left 4 Dead" href="http://store.steampowered.com/app/500/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/500/0f67ee504d8f04ecd83986dd7855821dc21f7a78.jpg);"></a></li>
                <li id="7"><a class="disabled-game" title="Counter-Strike: Global Offensive" href="http://store.steampowered.com/app/730/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/730/d0595ff02f5c79fd19b06f4d6165c3fda2372820.jpg);"></a></li>
                <li id="8"><a class="disabled-game" title="The Ship" href="http://store.steampowered.com/app/2400/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/2400/2b19a255140350735cf8461f6e893452e1eae95e.jpg);"></a></li>
                <li id="9"><a class="disabled-game" title="Call of Duty: Modern Warfare 2 - Multiplayer" href="http://store.steampowered.com/app/10190/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10190/070cad064b3a81d6ede0f6054d9eb763004a07e0.jpg);"></a></li>
                <li id="10"><a class="disabled-game" title="Call of Duty: Modern Warfare 2" href="http://store.steampowered.com/app/10180/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10180/82de30354cb5ee352609c47ea47b86797008e436.jpg);"></a></li>
                <li id="11"><a class="disabled-game" title="Magicka" href="http://store.steampowered.com/app/42910/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/42910/8c59c674ef40f59c3bafde8ff0d59b7994c66477.jpg);"></a></li>
                <li id="12"><a class="disabled-game" title="Killing Floor" href="http://store.steampowered.com/app/1250/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/1250/354c07a75cc16f6bf551b81d27f4eee3436fc2fb.jpg);"></a></li>
                <li id="13"><a class="disabled-game" title="Dead Island" href="http://store.steampowered.com/app/91310/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/91310/62632a275a4cc08f0238ed3d589ce1d8627fde91.jpg);"></a></li>
                <li id="14"><a class="disabled-game" title="Rome: Total War" href="http://store.steampowered.com/app/4760/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4760/134817933edf4f8d0665d456889c0315c416fff2.jpg);"></a></li>
                <li id="15"><a class="disabled-game" title="Medieval II: Total War" href="http://store.steampowered.com/app/4700/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4700/fcd1abd6380998e473b92690e28a9fe0a1a27b8d.jpg);"></a></li>
                <li id="16"><a class="disabled-game" title="Total War: SHOGUN 2" href="http://store.steampowered.com/app/34330/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/34330/c6f6e87e742a2e40689486423e8320bd318e3ec7.jpg);"></a></li>
              </ul>
            </div>
          </div>
          <div class="large-3 medium-3 small-3 columns">
            <div class="callout panel games disable-list disable-button">
              <a href="" class="button btn-add" data-index="3">Add a Friend</a>
              <ul class="games-list">
                <li id="0"><a class="disabled-game" title="Left 4 Dead 2" href="http://store.steampowered.com/app/550/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/550/205863cc21e751a576d6fff851984b3170684142.jpg);"></a></li>
                <li id="1"><a class="disabled-game" title="Counter-Strike: Source" href="http://store.steampowered.com/app/240/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/240/ee97d0dbf3e5d5d59e69dc20b98ed9dc8cad5283.jpg);"></a></li>
                <li id="2"><a class="disabled-game" title="Dungeon Defenders" href="http://store.steampowered.com/app/65800/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/65800/71af270cff61ab197f9932212012134a436d9682.jpg);"></a></li>
                <li id="4"><a class="disabled-game" title="Half-Life 2: Deathmatch" href="http://store.steampowered.com/app/320/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/320/6dd9f66771300f2252d411e50739a1ceae9e5b30.jpg);"></a></li>
                <li id="5"><a class="disabled-game" title="Counter-Strike" href="http://store.steampowered.com/app/10/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10/af890f848dd606ac2fd4415de3c3f5e7a66fcb9f.jpg);"></a></li>
                <li id="6"><a class="disabled-game" title="Left 4 Dead" href="http://store.steampowered.com/app/500/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/500/0f67ee504d8f04ecd83986dd7855821dc21f7a78.jpg);"></a></li>
                <li id="7"><a class="disabled-game" title="Counter-Strike: Global Offensive" href="http://store.steampowered.com/app/730/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/730/d0595ff02f5c79fd19b06f4d6165c3fda2372820.jpg);"></a></li>
                <li id="8"><a class="disabled-game" title="The Ship" href="http://store.steampowered.com/app/2400/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/2400/2b19a255140350735cf8461f6e893452e1eae95e.jpg);"></a></li>
                <li id="9"><a class="disabled-game" title="Call of Duty: Modern Warfare 2 - Multiplayer" href="http://store.steampowered.com/app/10190/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10190/070cad064b3a81d6ede0f6054d9eb763004a07e0.jpg);"></a></li>
                <li id="10"><a class="disabled-game" title="Call of Duty: Modern Warfare 2" href="http://store.steampowered.com/app/10180/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/10180/82de30354cb5ee352609c47ea47b86797008e436.jpg);"></a></li>
                <li id="11"><a class="disabled-game" title="Magicka" href="http://store.steampowered.com/app/42910/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/42910/8c59c674ef40f59c3bafde8ff0d59b7994c66477.jpg);"></a></li>
                <li id="12"><a class="disabled-game" title="Killing Floor" href="http://store.steampowered.com/app/1250/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/1250/354c07a75cc16f6bf551b81d27f4eee3436fc2fb.jpg);"></a></li>
                <li id="13"><a class="disabled-game" title="Dead Island" href="http://store.steampowered.com/app/91310/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/91310/62632a275a4cc08f0238ed3d589ce1d8627fde91.jpg);"></a></li>
                <li id="14"><a class="disabled-game" title="Rome: Total War" href="http://store.steampowered.com/app/4760/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4760/134817933edf4f8d0665d456889c0315c416fff2.jpg);"></a></li>
                <li id="15"><a class="disabled-game" title="Medieval II: Total War" href="http://store.steampowered.com/app/4700/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/4700/fcd1abd6380998e473b92690e28a9fe0a1a27b8d.jpg);"></a></li>
                <li id="16"><a class="disabled-game" title="Total War: SHOGUN 2" href="http://store.steampowered.com/app/34330/" style="background-image: url(http://media.steampowered.com/steamcommunity/public/images/apps/34330/c6f6e87e742a2e40689486423e8320bd318e3ec7.jpg);"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <footer>
          <a href="http://steampowered.com">Powered by Steam</a>
        </footer>
      </div>
    </div>


    <div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
      <h2 id="modalTitle">Enter your Steam ID or Steam URL</h2>
      <p class="lead">For example: http://steamcommunity.com/id/schubi89/</p>
      <form>
        <div class="row">
          <div class="large-12 columns">
            <div class="row collapse">
              <div class="small-10 columns">
                <input id="input-steamid" type="text" placeholder="Steam ID / Steam URL">
              </div>
              <div class="small-2 columns">
                <a id="btn-add-yourself" href="" class="button postfix">Go</a>
              </div>
            </div>
          </div>
        </div>
      </form>
      <p class="lead">or login in through steam</p>
      <a href="<?=SteamSignIn::genUrl()?>"><img src="img/sits_large_noborder.png"></a>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

    <div id="friendsModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
      <h2 id="modalTitle">Select a Friend</h2>
      <ul class="friends-list">
      </ul>
      <br style="clear: both;">
      <p class="lead">Or enter his Steam ID or Steam URL, example: http://steamcommunity.com/id/schubi89/</p>
      <form>
        <div class="row">
          <div class="large-12 columns">
            <div class="row collapse">
              <div class="small-10 columns">
                <input id="input-friend-steamid" type="text" placeholder="Steam ID / Steam URL">
              </div>
              <div class="small-2 columns">
                <a id="btn-add-friend" href="" class="button postfix">Go</a>
              </div>
            </div>
          </div>
        </div>
      </form>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
