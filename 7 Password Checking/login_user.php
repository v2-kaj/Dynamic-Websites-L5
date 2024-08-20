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

// Prepare and bind the statement to select the user by username
$stmt = $conn->prepare("SELECT id, password FROM dwusers WHERE username = ?");
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	// Verify the provided password against the hashed password in the database
	if (password_verify($password, $row["password"])) {
		// Password is correct, log in the user by putting their id in session
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
		// Password is incorrect
		header("Location: login.php");
		exit();
	}
} else {
	// No user found with that username
	header("Location: login.php");
	exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
