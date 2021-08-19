<?php

  require '../config/database.php';

  $queryParam = '';

  try {
    //Session validation.
    if (!isset($_SESSION['id'])) {
      header('Location: index.php');
    }

    $id = $_GET['id'];

    //We delete the user from the database.
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?;");
    $result = $stmt->execute([$id]);

    if ($result) {
      $queryParam = "success=User deleted succesfully.";
    } else {
      $queryParam = 'error=Error, try again.';
    }
    
    header("Location: index.php?$queryParam");

  } catch (Exception $e) {
    echo $e->getMessage();
  }

?>