<?php
session_start()
?>
<?php
 session_destroy();
 setcookie("user_id", "", time() - 3600, "/");
 header("Location: login.php");
 die();
?>
