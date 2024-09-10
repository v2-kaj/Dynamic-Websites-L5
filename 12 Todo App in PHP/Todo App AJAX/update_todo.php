<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('connect.php');

    // Get the raw POST data and decode the JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Check if the "id" and "text" fields are present in the JSON data
    if (isset($data['id']) && isset($data['text'])) {
        $id = $data['id'];
        $text = $data['text'];

        // Prepare the SQL query using prepared statements
        $stmt = $conn->prepare("UPDATE todo SET text = ? WHERE id = ?");

        // Bind the "text" and "id" parameters to the prepared statement
        $stmt->bind_param("si", $text, $id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Respond with a success message in JSON format
            echo json_encode(["status" => "succeeded", "message" => "Todo item updated successfully"]);
        } else {
            // Respond with an error message in JSON format
            echo json_encode(["status" => "error", "message" => "Failed to update todo item"]);
        }

        // Close the prepared statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Respond with an error if "id" or "text" field is missing
        echo json_encode(["status" => "error", "message" => "'id' and 'text' fields are required"]);
    }
} else {
    // Respond with an error if the request method is not POST
    echo json_encode(["status" => "error", "message" => "Invalid request method. This endpoint only accepts POST requests."]);
}
?>
