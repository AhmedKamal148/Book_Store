<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "test";
$erro = 'sorry';

try {
    $conn = new PDO("mysql:host = $host; dbname=$db", $user, $pass, array(
        PDO::ATTR_DEFAULT_FETCH_MODE =>  PDO::FETCH_LAZY
    ));
} catch (PDOException $e) {
    echo "Not Connected :-> " . $e->getMessage();
}