<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Repeat</title>
  </head>
  <body>
      <?php
        $msg = "Hello World!";
        for($i=0;$i<5;$i++){
          echo $i.", ".$msg;
          echo"<br>";
        }
      ?>
  </body>
</html>
