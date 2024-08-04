<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
</head>
<body>
    <br>
    <br>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Enter your name">
        <input type="submit" value="Submit">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            echo "<h1>Hello, $name!</h1>";  
        }
    ?>
    
</body>
</html>