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

  <ul class="header">
    <li><a href="index.php">Index</a></li>

    <?php if(isset($_SESSION['id'])): ?>
      <li><a href="logout.php">Logout</a></li>
    <?php endif; ?>
  </ul>
