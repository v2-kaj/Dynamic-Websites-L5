<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <h1>Update Product</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dwdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
    }

    // Check if form was submitted with required fields
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the product details from the form submission
        $product_id = $_POST["id"];
        $product_name = $_POST["name"];
        $product_price = $_POST["price"];
        $product_description = $_POST["description"];

        // Prepare and bind the SQL statement to update the product details
        $stmt = $conn->prepare("UPDATE dwproducts SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->bind_param("sdsi", $product_name, $product_price, $product_description, $product_id);

        // Execute the update
        if ($stmt->execute()) {
            echo "<p class='message success'>Product updated successfully!</p>";
            echo "<a href='all_products.php' class='back-link'>Go back to All Products</a>";
        } else {
            echo "<p class='message error'>Error updating product: " . $conn->error . "</p>";
        }

        // Close the statement
        $stmt->close();

    } else {
        echo "<p class='message error'>Invalid form submission.</p>";
    }

    // Close the connection
    $conn->close();
    ?>
</body>

</html>
