<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

<body>
    <h1>Product Details</h1>
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

    // Retrieve the id from the query parameter
    $id = $_GET["id"];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM dwproducts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch all rows from the result set
        $rows = $result->fetch_all(MYSQLI_ASSOC);
       
        
        // Loop through each row and output the product details
        foreach ($rows as $row) {
            echo "<p>Name: ".$row["name"]."</p>";
            echo "<p>Description: ".$row["description"]."</p>";
            echo "<p>Price: K" . $row["price"]."</p>";
            echo "<a href='edit_product.php?id=$id'>Edit</a>";
        }
    } else {
        echo "No results found.";
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
    ?>
    
    <br>
    
    <a href="all_products.php">Go back to All Products</a>
</body>

</html>
