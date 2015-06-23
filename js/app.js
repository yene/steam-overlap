$( "#btn-add-yourself" ).on("click", function() {
  $.getJSON( "games.php?steamid=76561197964515697&singleplayer=0&freegames=0&played=1", function( data ) {
    var items = [];
    $.each( data, function( key, val ) {
      items.push( "<li id='" + key + "'><a title='" + val.name  + "' href='http://store.steampowered.com/app/" + val.appid + "/'><img src='http://media.steampowered.com/steamcommunity/public/images/apps/" +
        val.appid + "/" + val.img_logo_url + ".jpg' alt='" + val.name  + "' ></a></li>" );
    });

    $( "<ul/>", {
      "class": "games-list",
      html: items.join( "" )
    }).appendTo( "#first" ); // TODO remove first
  });
})
