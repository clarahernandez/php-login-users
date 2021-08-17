<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
  }

  require 'database.php';

  try {
    if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];

      $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?;");
      $result = $stmt->execute([$name, $email, $id]);

      if ($result) {
        $message = 'User updated succesfully.';
      } else {
        $message = 'Error.';
      }
      header("Location: show.php?id=$id&message=$message");

    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }

?>
