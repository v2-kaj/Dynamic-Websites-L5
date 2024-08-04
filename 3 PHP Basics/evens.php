<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
    for($i=0; $i<=10;$i++){
        if($i%2 !== 0){
          continue;
        }
        else{
          echo($i."<br>");
        }
      }
    ?>


  </body>
</html>
