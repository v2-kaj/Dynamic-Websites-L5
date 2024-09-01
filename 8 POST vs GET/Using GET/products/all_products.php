<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All products</title>
</head>

<body>
    <h1>All products</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dwdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //use prepared statement
    $stmt = $conn->prepare("SELECT * FROM dwproducts");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($rows as $row) {
            echo "<a href='product_details.php?id=" . $row["id"] . " '>" . $row["name"] . "</a>";
            echo "<br>";
        }
      
    } else {
        echo "0 results";


    }
    $stmt->close();
    $conn->close();
    
    ?>
</body>

</html>