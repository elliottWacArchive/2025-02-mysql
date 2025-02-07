<?php

$servername = "localhost";
$username = "root";
$pwd = "auguste007";
$dbname = "cinema";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "PDO : Connected successfully\n";
} catch (PDOException $e) {
    echo "PDO : Connection failed: " . $e->getMessage() . "\n";
}
