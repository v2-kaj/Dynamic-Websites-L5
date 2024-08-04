<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vote</title>
</head>
<body>
<?php
      $age = 12;
      if($age >= 18) {
        echo "<h1>You are eligible to vote</h1>";
      } else {
        echo "<h1>You are not eligible to vote</h1>";
      }
    ?>
</body>
</html>