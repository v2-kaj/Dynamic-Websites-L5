<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('connect.php');

    // Get the raw POST data and decode the JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Check if the "text" field is present in the JSON data
    if (isset($data['text'])) {
        $text = $data['text'];

        // Prepare the SQL query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO todo (text) VALUES (?)");

        // Bind the "text" parameter to the prepared statement
        $stmt->bind_param("s", $text);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Respond with a success message in JSON format
            echo json_encode(["status" => "succeeded", "message" => "Todo item added successfully"]);
        } else {
            // Respond with an error message in JSON format
            echo json_encode(["status" => "error", "message" => "Failed to add todo item"]);
        }

        // Close the prepared statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Respond with an error if the "text" field is not provided in the JSON
        echo json_encode(["status" => "error", "message" => "Invalid input, 'text' field is required"]);
    }
} else {
    // Respond with an error if the request method is not POST
    echo json_encode(["status" => "error", "message" => "Invalid request method. This endpoint only accepts POST requests."]);
}
?>
