<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User account registration</title>
    <link rel="stylesheet" href="responsive.css" />
</head>

<body>
    <div class='row'>
        <header class='col-12'>
            <h1>DW APP</h1>
        </header>
    </div>
    <div class='row'>
        <div class='col-4'></div>
        <div class='col-4'>
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

            $username = $_POST["user_name"];
            $email = $_POST["user_email"];
            $password = $_POST["user_password"];

            // Check if the password meets minimum requirements
            if (!preg_match('/[A-Z]/', $password) ||
                !preg_match('/[a-z]/', $password) ||
                !preg_match('/[0-9]/', $password) ||
                !preg_match('/[\W]/', $password) ||
                strlen($password) < 8) {
                echo "<p>Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.</p>";
                exit();
            }

            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Check if the username already exists using a prepared statement
            $stmt = $conn->prepare("SELECT * FROM dwusers WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p>Username already exists</p>";
                echo "<a href='login.php'>Login</a>";
                exit();
            }

            // Insert the new user into the database using a prepared statement
            $stmt = $conn->prepare("INSERT INTO dwusers (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            // Execute the statement and check if the insertion was successful
            if ($stmt->execute()) {
                echo "<p>You have successfully registered</p>";
                echo "<a href='login.php'>Go to the login page</a>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement and the connection
            $stmt->close();
            $conn->close();
            ?>
        </div>
        <div class='col-4'></div>
    </div>
</body>
</html>
