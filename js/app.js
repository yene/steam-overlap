var ids = []; // array, index is the column
var games = []; // array, index is the column

$( document ).ready(function() {

  var param = getUrlParameter('ids');
  if (param) {
    $.getJSON( "games.php?steamids=" + param + "&singleplayer=0&freegames=0&played=1", function( data ) {
      console.log(data);
      data.forEach(function(element, index, array) {
        if (index > 3) {
          // TODO add more columns
          return;
        }
        if (index < 3) {
          $( ".games:eq(" + (index+1) + ")").removeClass("disable-button");
        }
        showResultInColumn(element.games, index);

        $( ".games:eq(" + index + ") .button").text(element.personaname);
        $( ".games:eq(" + index + ") .button").css("background-image", "url(" + element.avatar + ")");

        $( ".games:eq(" + index + ")").removeClass("disable-list");
        $( ".games:eq(" + index + ")").removeClass("disable-button");
      });
    });
  }
});


$( "#btn-add-yourself" ).on("click", function() {
  $('#myModal').foundation('reveal', 'close');
  var steamid = $('#input-steamid').val();
  $.getJSON( "games.php?steamid=" + steamid + "&singleplayer=0&freegames=0", function( data ) {
    showResultInColumn(data, 0);
  });
  // change button to edit ->

  // add id to url
  addIDToURL(steamid);
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
