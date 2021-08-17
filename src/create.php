<?php

  require 'database.php';

  $message = '';
  try {
    if (isset($_POST['create'])) {

      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
  
      if (!$stmt) {
        echo "\nPDO::errorInfo():\n";
        print_r($db->errorInfo());
      }
  
      $result = $stmt->execute();
  
  
      if ($result) {
        $message = 'Successfully created new user';
        header('Location: index.php');
      } else {
        $message = 'Sorry there must have been an issue creating the new user';
      }
    } 
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  
  
?>

<?php require 'partials/header.php' ?>


  <h3>Ingresar usuario</h3>
  <form action="create.php" method="POST">
    <input name="name" type="text" placeholder="Enter your name">
    <input name="email" type="text" placeholder="Enter your email">
    <input name="password" type="password" placeholder="Enter your Password">
    <input name="confirm_password" type="password" placeholder="Confirm Password">
    <input type="submit" value="Submit" name="create">
  </form>
  </body>
</html>