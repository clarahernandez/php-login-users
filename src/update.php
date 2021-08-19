<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
  }

  require '../config/database.php';

  try {
    if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];

      //We search if the user email exists in the database.
      $select = $db->prepare("SELECT * FROM users WHERE email = '$email';");
      $select->execute();
      $resultado = $select->fetch(PDO::FETCH_OBJ);

      if ($resultado) {
        $query = '&success=The email is used.';
      } else {

        $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?;");
        $result = $stmt->execute([$name, $email, $id]);

        if ($result) {
          $query = '&success=User updated succesfully.';
        } else {
          $query = '&error=Error.';
        }
      }
      header("Location: show.php?id=$id$query");
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }

?>
