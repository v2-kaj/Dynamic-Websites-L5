<?php
// Start the session
session_start();
if(!isset($_SESSION["isloggedin"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Profile</title>
	<link rel="stylesheet" href="responsive.css"/>
</head>
<body>
	<div class='row'>
		<header class='col-12'>
      <h1>DW App</h1>
    </header>
	</div>
	<div class='row'>
		<div class='col-2'></div>
		<div class='col-8'>
            <h2>Profile:
                <?php
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
                    $id = $_SESSION["user_id"];
                    $command = "SELECT * FROM dwusers WHERE id=$id";
                    $result = mysqli_query($conn, $command);

                    if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo $row['username']. " ".$row['email'];
                    }
                    else{
                        echo "Error occurred";
                    }
                    mysqli_close($conn);
                ?>
            </h2>
            <a href="logout.php">Logout</a>
		</div>
		<div class='col-2'></div>
	</div>
</body>
</html>
