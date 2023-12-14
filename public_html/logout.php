<?php
session_start();
session_destroy();
header("Location: LoginPage.php"); // Redirect to the login page after logout
exit();
?>