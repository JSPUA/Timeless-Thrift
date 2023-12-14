<?php
include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $age = $_POST["age"];
    $len = $_POST["len"];
    $hem = $_POST["hem"];
    $strap = $_POST["strap"];
    $bodice = $_POST["bodice"];
    $bust = $_POST["bust"];
    $armhole = $_POST["armhole"];
    $skirt = $_POST["skirt"];
    $waist = $_POST["waist"];
    $neckline = $_POST["neckline"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $streetAddress1 = $_POST["streetAddress1"];
    $streetAddress2 = $_POST["streetAddress2"];
    $city = $_POST["city"];
    $postCode = $_POST["postCode"];
    $region = $_POST["region"];
    $country = $_POST["country"];
    $userid = uniqid("user");
$sql = "INSERT INTO user (user_id,username, age, len, hem, strap, bodice, bust, armhole,
                               skirt, waist, neckline, email, phone, password, streetAddress1,
                               streetAddress2, city, postCode, region, country) VALUES
                               ('$userid','$username', '$age', '$len', '$hem', '$strap', '$bodice', '$bust',
                               '$armhole', '$skirt', '$waist', '$neckline', '$email',
                               '$phone', '$password', '$streetAddress1', '$streetAddress2', '$city',
                               '$postCode', '$region', '$country'
                               )";
$stmt = $pdo->prepare($sql);
    if ($stmt -> execute() === TRUE) {
        echo "Data insert successfully！";
        header("Location: LoginPage.php");
    } else {
        echo "Insert Faild: " ;
    }
}
?>
