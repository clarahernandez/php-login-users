<?php

require '../config/database.php';

  try {
    if (!isset($_GET['id'])) {
      header('Location: index.php');
    }

    $id = $_GET['id'];
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?;");
    $result = $stmt->execute([$id]);

    if ($result) {
      $message = 'User deleted succesfully.';
    } else {
      $message = 'Error.';
    }
    header("Location: index.php?id=$id&message=$message");

  } catch (Exception $e) {
    echo $e->getMessage();
  }

?>