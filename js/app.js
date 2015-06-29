var ids = []; // array, index is the column
var games = []; // array, index is the column

$( document ).ready(function() {
  loadGames();
  loadFriends();

});

$( "#btn-add-yourself" ).on("click", function(e) {
  e.preventDefault();

  $('#myModal').foundation('reveal', 'close');
  var steamID = $('#input-steamid').val(); // TODO GET IT FROM STEAM BUTTON

  // add id to url
  addIDToURL(steamID);

  // trigger load
  loadGames();

  // setup friends view
  loadFriends();
});

$( "#btn-add-friend" ).on("click", function(e) {
  e.preventDefault();

  $('#friendsModal').foundation('reveal', 'close');
  var steamID = $('#input-friend-steamid').val(); // TODO GET IT FROM STEAM BUTTON
  steamID = getSteamID(steamID);
  if (steamID) {
    addIDToURL(steamID);
    loadGames();
  }
});


function showResultInColumn(result, column) {
  var items = [];
  $.each( result, function( key, val ) {
    var style = "";
    if (!val.owned) {
      style = "class='disabled-game'";
    }

    var played = "Never played.";
    if (val.playtime_forever > 0 ) {
      played = "Played for " + val.playtime_forever + " hours.";
    }

    var image = "http://media.steampowered.com/steamcommunity/public/images/apps/" + val.appid + "/" + val.img_logo_url + ".jpg";
    items.push( "<li id='" + key + "'><a " + style + " title='" + val.name  + "' href='http://store.steampowered.com/app/" + val.appid +
      "/' style='background-image: url(" + image + ");'>" + "</a></li>" );
  });
  $( ".games:eq(" + column + ") ul.games-list").empty().append(items.join( "" ));
}

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}

function addIDToURL(steamid) {
  var param = getUrlParameter('ids');
  if (param) {
    window.history.pushState("object or string", "Title", "/?ids=" + param + "," + steamid);
  } else {
    window.history.pushState("object or string", "Title", "/?ids=" + steamid);
  }
}

function loadFriends() {
  var param = getUrlParameter('ids');
  if (param) {
    var firstID = param.split(",")[0];
    $.getJSON( "friends.php?steamid=" + firstID, function( data ) {
      var items = [];
      data.forEach(function(element, index, array) {
        items.push( "<li><a href='' data-steamid='" + element.steamid + "'><img src='" + element.avatarmedium + "' title='"  + (element.personaname) + "' alt='"  + (element.personaname) + "'></a></li>" );
      });
      $(".friends-list").empty().append(items.join( "" ));
      $( ".friends-list a" ).on("click", function(e) {
        e.preventDefault();
        var friendSteamID = $(this).data("steamid");
        addIDToURL(friendSteamID);
        loadGames();
        $('#friendsModal').foundation('reveal', 'close');
      });
    });
  }
}

function loadGames() {
  var param = getUrlParameter('ids');
  if (param) {
    $.getJSON( "games.php?steamids=" + param + "&singleplayer=0&freegames=0&played=1", function( data ) {
      data.forEach(function(element, index, array) {
        if (index > 0 && index < 3) {
          var template = $(".js-template");
          template.clone().appendTo(".js-games");
          template.removeClass("js-template");
        }
        showResultInColumn(element.games, index);

        $( ".games:eq(" + index + ") .button").text(element.personaname);
        $( ".games:eq(" + index + ") .button").css("background-image", "url(" + element.avatar + ")");

        $( ".games:eq(" + index + ")").removeClass("disable-list");
        $( ".games:eq(" + index + ")").removeClass("disable-button");


        if (index < 3) {
          $( ".games:eq(" + (index + 1) + ")").removeClass("disable-button");
        }
      });
    });
  }
}

function getSteamID(p) {

  p = p.trim();

  // check for valid steam64 id
  if (!isNaN(parseInt(p, 10))) {
    return p;
  }

  // http://steamcommunity.com/profiles/76561197960473866 -> get last part
  if (p.includes("steamcommunity.com/profiles/")) {
    var parts = p.split("/").filter(Boolean);
    return parts[parts.length-1];
  }

  if (p.includes("steamcommunity.com/id/")) {
    var parts = p.split("/").filter(Boolean); // removes empty string from array
    var id = parts[parts.length-1];
    // http://steamcommunity.com/id/schubi89/ -> backend convert custom url to steamid
    $.getJSON( "customURL.php?id=" + id, function( data ) {
      var steamID = data[0];
      addIDToURL(steamID);
      loadGames();
    });
  }
  return false;
}
