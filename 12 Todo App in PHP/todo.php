<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
</head>

<body>
    <h1>Todo App</h1>
    <ol>
        <?php
        require_once('connect.php');

        // Prepare the SQL statement to select all tasks
        $stmt = $conn->prepare("SELECT * FROM todo");
        // Execute the prepared statement
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of each task
            while ($task = $result->fetch_assoc()) {
                // Use htmlspecialchars to prevent XSS attacks
                $taskText = $task["text"];
                $taskId = (int)$task["id"]; // Cast to ensure it's an integer
                echo "<li>" . $taskText . " <a href='update_todo_page.php?id=$taskId'>Edit</a> <a href='delete_todo_page.php?id=$taskId'>Del</a></li>";
            }
        } else {
            echo "No Tasks";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </ol>

    <form action="addTodo.php" method="POST">
        <input type="text" id="taskField" name="task" placeholder="task">
        <input type="submit">
    </form>
</body>

</html>
