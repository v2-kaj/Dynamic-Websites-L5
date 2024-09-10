<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('connect.php');

    // Get the raw POST data and decode the JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Check if the "id" field is present in the JSON data
    if (isset($data['id'])) {
        $id = $data['id'];

        // Prepare the SQL query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM todo WHERE id = ?");

        // Bind the "id" parameter to the prepared statement
        $stmt->bind_param("i", $id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Respond with a success message in JSON format
            echo json_encode(["status" => "succeeded", "message" => "Todo item deleted successfully"]);
        } else {
            // Respond with an error message in JSON format
            echo json_encode(["status" => "error", "message" => "Failed to delete todo item"]);
        }

        // Close the prepared statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Respond with an error if the "id" field is not provided in the JSON
        echo json_encode(["status" => "error", "message" => "Invalid input, 'id' field is required"]);
    }
} else {
    // Respond with an error if the request method is not POST
    echo json_encode(["status" => "error", "message" => "Invalid request method. This endpoint only accepts POST requests."]);
}
?>
