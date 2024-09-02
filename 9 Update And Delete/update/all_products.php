<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
</head>

<body>
    <h1>All Products</h1>

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

    // Use prepared statement
    $stmt = $conn->prepare("SELECT id, name, price FROM dwproducts");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Product Name</th><th>Price</th><th>Actions</th></tr>";

        // Fetch all results as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Loop through the array of products and display them in the table using foreach
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td><a href='product_details.php?id=" . $row["id"] . " '>" . $row["name"] . "</a></td>";
            echo "<td>K" . number_format($row["price"], 2) . "</td>";
            echo "<td><a href='edit_product.php?id=" . $row["id"] . "'>Edit</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No products found.</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>

</body>
</html>
