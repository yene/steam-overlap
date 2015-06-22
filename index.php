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
</head>
<body>
  <header>
    <nav>
      <ul>
        <li>Menu item</li>
      </ul>
    </nav>
  </header>
  <main>
    <article>
      <header>
        <h2>Article title</h2>
        <p>Posted on <time datetime="2011-04-15T16:31:24+02:00">April 15th 2011</time> by <a href="#">Writer</a> â€“ <a href="#comments">6 comments</a></p>
      </header>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
    </article>
  </main>
  <aside>
    <h2>About section</h2>
    <p>Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
  </aside>
  <footer>
    <p>Copyright 2011 Your name</p>
  </footer>
</body>
</html>
