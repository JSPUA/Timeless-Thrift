<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    echo $row;
    if (!empty($row)) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION['user_id'] =  $row['user_id'];

        if(!empty($_SESSION['current_id'])){
            header("Location: ./product.php?id=".$_SESSION['current_id']);
        }
        else{
            header("Location: index.php"); //Route to new page
        }
        exit();
    } else {

        echo "<script>alert('Login failed, Please check Username and Password'); window.location.href='LoginPage.php';</script>";
        exit();
    }
}
?>