<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <h1>RESULTS</h1>
    <?php
        $query = $_GET['q'];
        echo "Searching for: ".$query; 
        echo "<p>Here would be the results: of $query</p>";
    ?>
    <br>
    <br>
    <a href="colleges.html">Back</a>
</body>
</html>