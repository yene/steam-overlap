<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My shiny site</title>
  <!-- Normalize.css is a customisable CSS file that makes browsers render all elements more consistently and in line with modern standards. -->
  <link rel="stylesheet" media="screen" href="https://raw.github.com/necolas/normalize.css/master/normalize.css">

  <style>
    html, body, main {
      height: 100%;
      width: 100%;
    }
    /* apply a natural box layout model to all elements, but allowing components to change */
    html {
      box-sizing: border-box;
    }
    *, *:before, *:after {
      box-sizing: inherit;
    }

    body {
      /* best helvetica */
      font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
      font-weight: 300;
    }

  </style>
  <script src="jquery-2.1.4.min.js"></script>
  <script>
    $( document ).ready(function() {
      $.getJSON( "api.php", function( data ) {
        var items = [];
        $.each( data, function( key, val ) {
          items.push( "<li id='" + key + "'><img src=http://media.steampowered.com/steamcommunity/public/images/apps/" + val.appid + "/" + val.img_logo_url + ".jpg>" + val.name + " Count: <strong>" + val.count + "</strong> </li>" );
        });

        $( "<ul/>", {
          "class": "my-new-list",
          html: items.join( "" )
        }).appendTo( "body" );
      });
    })
  </script>
</head>
<body>
<h1>Games that overlap with your friends</h1>

<div>
 add friend textfield + button
 * friend +, friend 2, friend 3
</div>
<div>
adss
</div>


</body>
</html>
