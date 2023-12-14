<?php 

session_start();

// if(empty($_SESSION['user_id'])){
//     header("Location: LoginPage.php");
// }

$sessObj = new Session();

class Session {
    function getSessionID(){
        return $_SESSION['user_id'];
    }

    function getSessionName(){
        return $_SESSION['username'];
    }
}
