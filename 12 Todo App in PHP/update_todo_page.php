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

    // Use prepared statements to secure the query
    $id = $_GET["id"];
    $_SESSION['id'] = $id;

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM todo WHERE id = ?");
    // Bind the parameter to the statement
    $stmt->bind_param("i", $id);
    // Execute the prepared statement
    $stmt->execute();
    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of the task
        $task = $result->fetch_assoc();
        echo "<form action=\"update_todo_processor.php\">";
        echo "<h2>Update Task</h2>";
        echo "<input type='text' name='task_text' value='".htmlspecialchars($task['text'], ENT_QUOTES)."'/>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "No Tasks";
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>
</body>

</html>
