<?php


require 'vendor/autoload.php';
require 'EmailSender.php';
require 'UserRegistration.php';

$host = 'localhost';
$dbname = 'task';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userRegistration = new UserRegistration($pdo);
        $userRegistration->registerUser($_POST["gender"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["phone"]);
    }
} catch (PDOException $e) {
    echo "PDO Xətası: " . $e->getMessage();
} catch (Exception $e) {
    echo "Xəta: " . $e->getMessage();
}
