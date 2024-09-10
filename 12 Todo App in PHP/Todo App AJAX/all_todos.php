<?php
    require_once('connect.php');

    // Prepare the SQL query using prepared statements
    $stmt = $conn->prepare("SELECT id, text FROM todo");
    
    // Execute the query
    $stmt->execute();

    // Fetch the results as an associative array
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Convert the results to JSON
    header('Content-Type: application/json');
    echo json_encode($results);

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
?>
