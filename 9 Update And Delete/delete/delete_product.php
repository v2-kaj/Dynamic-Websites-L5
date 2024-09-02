<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>

<body>
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

    // Check if an ID was provided in the query string
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Prepare the DELETE statement
        $stmt = $conn->prepare("DELETE FROM dwproducts WHERE id = ?");
        $stmt->bind_param("i", $product_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p class='message success'>Product deleted successfully!</p>";
            echo "<a href='all_products.php'>Go back to All Products</a>";
        } else {
            echo "<p class='message error'>Error deleting product: " . $conn->error . "</p>";
            echo "<a href='all_products.php'>Go back to All Products</a>";
            
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p class='message error'>No product ID provided.</p>";
        echo "<a href='all_products.php'>Go back to All Products</a>";
    }

    // Close the connection
    $conn->close();
    
    ?>


</body>

</html>