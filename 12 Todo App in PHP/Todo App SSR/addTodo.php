<?php
	require_once('connect.php');

    // Retrieve the task from POST request and trim to remove any extra whitespace
    $task = trim($_POST["task"]);

    // Prepare the SQL statement with a placeholder
    $stmt = $conn->prepare("INSERT INTO todo (text) VALUES (?)");

    // Bind the task parameter to the statement
    $stmt->bind_param("s", $task);  // "s" indicates the parameter is a string

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the todo list if insertion was successful
        header("Location: todo.php");
    } else {
        // Output an error message if something went wrong
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
?>
