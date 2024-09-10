<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
</head>

<body>
    <?php
    require_once('connect.php');

    // Get the task ID from the query string, ensure it's an integer
    $id = $_GET["id"];

    // Prepare a DELETE statement
    $stmt = $conn->prepare("DELETE FROM todo WHERE id = ?");
    
    // Bind the task ID as an integer parameter to the statement
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the todo list if the deletion was successful
        header("Location: todo.php");
    } else {
        // Output an error message if something went wrong
        echo "Something went wrong";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>
</body>

</html>
