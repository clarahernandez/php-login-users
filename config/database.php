<?php

//Configuration:
$server = 'localhost';
$username = '';
$password = '';
$database = '';

try {
  $db = new PDO(
    "mysql:host=$serever;
    dbname=$database",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
    echo 'Unable to connect: ' . $e->getMessage();
}

?>