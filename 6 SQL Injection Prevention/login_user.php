<?php
// Start the session
session_start();
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

$username = $_POST["user_name"];
$password = $_POST["user_password"];
$remember = isset($_POST["remember_me"]) ? $_POST["remember_me"] : 0;

// Prepare and bind
$stmt = $conn->prepare("SELECT id FROM dwusers WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Authenticate a user
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	// Log in the user by putting their id in session
	$_SESSION["user_id"] = $row["id"];
	$_SESSION["isloggedin"] = true;

	if ($remember == 1) {
		// If the user wants to be remembered, set a cookie
		setcookie("user_id", $row["id"], time() + 60 * 60 * 24 * 7, "/");
	}
	// After successful login, redirect the user to the profile page
	header("Location: profile.php");
	exit();

} else {
	// Authentication failed
	header("Location: login.php");
	exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
