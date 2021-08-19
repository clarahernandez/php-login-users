<?php

  require '../config/database.php';

  $REGEX = "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

  $error = '';

  try {
    if (isset($_POST['create'])) {

      //Empty fields validation.
      if (empty($_POST['name']) ||
          empty($_POST['email']) ||
          empty($_POST['password'])
      ) {
        $error = 'Inputs cannot be empty.';       
      } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //Password encryptation


        //Unique email validation.
        $select = $db->prepare("SELECT * FROM users WHERE email = '$email';");
        $select->execute();
        $userExists = $select->fetch(PDO::FETCH_OBJ);

        if ($userExists) {
          $error = 'The email is used.';
        } elseif (!filter_var( $email, FILTER_VALIDATE_EMAIL)) {
          $error = 'No valid email.';
        } else {

          //User creation in the database.
          $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");      
          $result = $stmt->execute();
    
          if ($result) {
            $error = ''; //clean errors
            $success = 'User created successfully.';
          } else {
            $success = ''; //clean success
            $error = 'Sorry there must have been an issue creating the new user. Try again.';
          }
        }
      }
    } 
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  
  
?>

<?php require 'partials/header.php' ?>


  <h3>Create user:</h3>

  <?php if(!empty($success)): ?>
    <p class="success"> <?= $success ?></p>
  <?php endif; ?> 

  <form action="create.php" method="POST">
    <input name="name" type="text" placeholder="Enter your name">
    <input name="email" type="text" placeholder="Enter your email">
    <input name="password" type="password" placeholder="Enter your Password">

    <?php if(!empty($error)): ?>
      <p class="error"> <?= $error ?></p>
    <?php endif; ?> 

    <input type="submit" value="Submit" name="create">
  </form>
  </body>
</html>