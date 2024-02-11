<?php
require_once("login.php");

$dsn = "mysql:host=localhost;dbname=latecheckdb";
$dbUsername = "root";
$dbPassword = "";

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}