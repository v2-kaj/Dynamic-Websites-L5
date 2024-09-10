<?php
session_start();

require_once('connect.php');

// Retrieve the task ID from the session and task text from the GET request
$id = $_GET['id'];
echo $id;
$text = $_GET['task_text'];

// Prepare the SQL statement with placeholders
$stmt = $conn->prepare("UPDATE todo SET text = ? WHERE id = ?");

// Bind the task text (string) and ID (integer) to the prepared statement
$stmt->bind_param("si", $text, $id); // "s" for string and "i" for integer

// Execute the statement
if ($stmt->execute()) {
    // Redirect to the todo list if the update was successful
    header("Location: todo.php");
} else {
    // Output an error message if something went wrong
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
