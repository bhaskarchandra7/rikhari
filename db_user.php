<?php
$userDbHost = 'localhost';
$userDbName = 'user_auth';
$userDbUsername = 'root';
$userDbPassword = '';

try {
    $userDb = new PDO("mysql:host=$userDbHost;dbname=$userDbName", $userDbUsername, $userDbPassword);
    $userDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("User database connection failed: " . $e->getMessage());
}
?>
