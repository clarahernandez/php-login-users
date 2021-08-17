<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
  <header>
    <a href="index.php">Index</a>

    <?php if(isset($_SESSION['id'])): ?>
      <a href="logout.php">Logout</a>
    <?php endif; ?>
  </header>