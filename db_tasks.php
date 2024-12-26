<?php
$taskDbHost = 'localhost';
$taskDbName = 'user_data';
$taskDbUsername = 'root';
$taskDbPassword = '';

try {
    $taskDb = new PDO("mysql:host=$taskDbHost;dbname=$taskDbName", $taskDbUsername, $taskDbPassword);
    $taskDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Task database connection failed: " . $e->getMessage());
}
?>
