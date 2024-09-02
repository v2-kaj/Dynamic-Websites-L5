<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>

<body>
    <h1>Edit Product</h1>

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

    // Get the product ID from the URL
    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Prepare the SQL statement to get the product details
    $stmt = $conn->prepare("SELECT * FROM dwproducts WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        // Fetch the product details
        $product = $result->fetch_assoc();
    ?>
        <!-- Edit product form with pre-filled details -->
        <form action="update_product.php" method="post">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <div>
                <label for="name">Product Name:</label>
                <br>
                <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <br>
                <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <br>
                <textarea id="description" name="description" rows="4" cols="50"><?php echo $product['description']; ?></textarea>
            </div>


            <div>
                <input type="submit" value="Update Product">
            </div>
        </form>
    <?php
    } else {
        echo "<p>Product not found.</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>

</body>
</html>
