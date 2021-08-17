<?php

  require '../config/database.php';

  $queryParam = '';

  try {
    //Validación de la sesión.
    if (!isset($_SESSION['id'])) {
      header('Location: index.php');
    }

    $id = $_GET['id'];

    //Se elimina el usuario de la base de datos
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