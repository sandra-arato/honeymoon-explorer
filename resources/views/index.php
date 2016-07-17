<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nászútválasztó</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link rel="icon" href="static/logo.png" type="image/x-icon">
  </head>
  <body>
    <div id="app"></div>
    <script src="static/build.js"></script>
    <script>
      (function(){
        var header = document.getElementById('footer').children[0];
        console.log(document.getElementById('footer'), header);
        header.addEventListener('click', function(e) {
          e.target.classList.toggle('hidden');
        })
      }());
    </script>
  </body>
</html>
