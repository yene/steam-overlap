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
              <a href="" class="button" data-reveal-id="myModal">Add Yourself</a>
              <ul class="games-list">
                <li id="11"><a title="Counter-Strike: Source" href="http://store.steampowered.com/app/240/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/240/ee97d0dbf3e5d5d59e69dc20b98ed9dc8cad5283.jpg" alt="Counter-Strike: Source"></a></li>
                <li id="37"><a title="Left 4 Dead" href="http://store.steampowered.com/app/500/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/500/0f67ee504d8f04ecd83986dd7855821dc21f7a78.jpg" alt="Left 4 Dead"></a></li>
                <li id="47"><a title="Left 4 Dead 2" href="http://store.steampowered.com/app/550/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/550/205863cc21e751a576d6fff851984b3170684142.jpg" alt="Left 4 Dead 2"></a></li>
                <li id="50"><a title="Call of Duty: Modern Warfare 2 - Multiplayer" href="http://store.steampowered.com/app/10190/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/10190/070cad064b3a81d6ede0f6054d9eb763004a07e0.jpg" alt="Call of Duty: Modern Warfare 2 - Multiplayer"></a></li>
                <li id="53"><a title="Men of War" href="http://store.steampowered.com/app/7830/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/7830/b34d63eb274c8fe1e343e67d54e6d929dcad4afb.jpg" alt="Men of War"></a></li>
                <li id="57"><a title="Supreme Commander 2" href="http://store.steampowered.com/app/40100/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/40100/b7a38d7f959d3e76f71d7a6d8a6bfb3e89b4e7d0.jpg" alt="Supreme Commander 2"></a></li>
                <li id="59"><a title="Battlefield: Bad Company 2" href="http://store.steampowered.com/app/24960/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/24960/969a07d20786b5f536122d70f2c3eedc1eca5ede.jpg" alt="Battlefield: Bad Company 2"></a></li>
                <li id="69"><a title="Sid Meier" s="" civilization="" v'="" href="http://store.steampowered.com/app/8930/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/8930/2203f62bd1bdc75c286c13534e50f22e3bd5bb58.jpg" alt="Sid Meier" s="" civilization="" v'=""></a></li>
                <li id="70"><a title="Star Ruler" href="http://store.steampowered.com/app/70900/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/70900/47cf21bd3ed9d3180a9109ed5c91002b5e013af8.jpg" alt="Star Ruler"></a></li>
                <li id="71"><a title="Lost Planet 2" href="http://store.steampowered.com/app/45750/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/45750/c0378cbeecba568eaf1cf7f6ddda89b857f59e07.jpg" alt="Lost Planet 2"></a></li>
                <li id="82"><a title="Greed Corp" href="http://store.steampowered.com/app/48950/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/48950/a7521ac7891b0ac947c3676726af0109f0f2638e.jpg" alt="Greed Corp"></a></li>
              </ul>
            </div>
          </div>
          <div class="large-3 medium-3 small-3 columns js-template">
            <div class="callout panel games disable-list disable-button">
              <a href="" class="button" data-reveal-id="friendsModal">Add a Friend</a>
              <ul class="games-list">
                <li id="11"><a title="Counter-Strike: Source" href="http://store.steampowered.com/app/240/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/240/ee97d0dbf3e5d5d59e69dc20b98ed9dc8cad5283.jpg" alt="Counter-Strike: Source"></a></li>
                <li id="37"><a title="Left 4 Dead" href="http://store.steampowered.com/app/500/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/500/0f67ee504d8f04ecd83986dd7855821dc21f7a78.jpg" alt="Left 4 Dead"></a></li>
                <li id="47"><a title="Left 4 Dead 2" href="http://store.steampowered.com/app/550/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/550/205863cc21e751a576d6fff851984b3170684142.jpg" alt="Left 4 Dead 2"></a></li>
                <li id="50"><a title="Call of Duty: Modern Warfare 2 - Multiplayer" href="http://store.steampowered.com/app/10190/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/10190/070cad064b3a81d6ede0f6054d9eb763004a07e0.jpg" alt="Call of Duty: Modern Warfare 2 - Multiplayer"></a></li>
                <li id="53"><a title="Men of War" href="http://store.steampowered.com/app/7830/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/7830/b34d63eb274c8fe1e343e67d54e6d929dcad4afb.jpg" alt="Men of War"></a></li>
                <li id="57"><a title="Supreme Commander 2" href="http://store.steampowered.com/app/40100/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/40100/b7a38d7f959d3e76f71d7a6d8a6bfb3e89b4e7d0.jpg" alt="Supreme Commander 2"></a></li>
                <li id="59"><a title="Battlefield: Bad Company 2" href="http://store.steampowered.com/app/24960/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/24960/969a07d20786b5f536122d70f2c3eedc1eca5ede.jpg" alt="Battlefield: Bad Company 2"></a></li>
                <li id="69"><a title="Sid Meier" s="" civilization="" v'="" href="http://store.steampowered.com/app/8930/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/8930/2203f62bd1bdc75c286c13534e50f22e3bd5bb58.jpg" alt="Sid Meier" s="" civilization="" v'=""></a></li>
                <li id="70"><a title="Star Ruler" href="http://store.steampowered.com/app/70900/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/70900/47cf21bd3ed9d3180a9109ed5c91002b5e013af8.jpg" alt="Star Ruler"></a></li>
                <li id="71"><a title="Lost Planet 2" href="http://store.steampowered.com/app/45750/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/45750/c0378cbeecba568eaf1cf7f6ddda89b857f59e07.jpg" alt="Lost Planet 2"></a></li>
                <li id="82"><a title="Greed Corp" href="http://store.steampowered.com/app/48950/"><img src="http://media.steampowered.com/steamcommunity/public/images/apps/48950/a7521ac7891b0ac947c3676726af0109f0f2638e.jpg" alt="Greed Corp"></a></li>
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
