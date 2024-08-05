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

            // check if the username already exists
            $sql = "SELECT * FROM dwusers WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<p>Username already exists</p>";
                echo "<a href='create_account.html'>Go back to the registration page</a>";
                exit();
            }

            $sql = "INSERT INTO dwusers (username, email, password) VALUES ('$username', '$email','$password')";

            //Execute the sql
            if (mysqli_query($conn, $sql)) {
                //This block will execute if data was successfully inserted into the database
                echo "<p>You have successfully registered</p>";
                echo "<a href='login.php'>Go to the login page</a>";
            } else {

                echo "Error: " . $sql . "<br>" . mysqli_error($conn);

            }
            mysqli_close($conn);
            ?>
        </div>
        <div class='col-4'></div>
    </div>
</body>
</html>