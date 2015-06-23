var ids = []; // array, index is the column
var games = []; // array, index is the column

$( document ).ready(function() {

  playerInfoForURL("http://steamcommunity.com/id/yene/?xml=1");

  var param = getUrlParameter('ids');
  if (param) {
    ids = param.split(",");
    ids.forEach(function(element, index, array) {
      if (index > 3) {
        // TODO add more columns
        return;
      }

      if (index < 3) {
        $( ".games:eq(" + (index+1) + ")").removeClass("disable-button");
      }

      $.getJSON( "games.php?steamid=" + element + "&singleplayer=0&freegames=0&played=1", function( data ) {
        games[index] = data;
        showResultInColumn(data, index);
        $( ".games:eq(" + index + ")").removeClass("disable-list");
        $( ".games:eq(" + index + ")").removeClass("disable-button");
      });
    });
  }

});


$( "#btn-add-yourself" ).on("click", function() {
  $('#myModal').foundation('reveal', 'close');
  var steamid = $('#input-steamid').val();
  $.getJSON( "games.php?steamid=" + steamid + "&singleplayer=0&freegames=0&played=1", function( data ) {
    showResultInColumn(data, 0);
  });
  // change button to edit ->
});

function showResultInColumn(result, column) {
  var items = [];
  $.each( result, function( key, val ) {
    items.push( "<li id='" + key + "'><a title='" + val.name  + "' href='http://store.steampowered.com/app/" + val.appid + "/'><img src='http://media.steampowered.com/steamcommunity/public/images/apps/" +
      val.appid + "/" + val.img_logo_url + ".jpg' alt='" + val.name  + "' ></a></li>" );
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
