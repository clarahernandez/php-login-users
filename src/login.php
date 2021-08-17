<?php
  session_start();
  if (isset($_SESSION['id'])) {
    header('Location: index.php');
  }
  
  try {
    require '../config/database.php';

    $message = '';

    if(isset($_POST['submit'])) {
      if (
          !empty($_POST['email']) &&
          !empty($_POST['password'])
      ) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM users WHERE email = '$email';");
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user === FALSE || !password_verify($password, $user->password)) {
          $error = 'Invalid email or password.';
        } else {
          $_SESSION['id'] = $user->id;
          header('Location: index.php');
        }
      } else {
        $error = 'Inputs cannot be empty.';
      }
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }

?>

<?php require 'partials/header.php' ?>

<?php if(!empty($resultado)): ?>
        <p> <?php echo $resultado; ?>/p>
      <?php endif; ?> 


    <h1>Login</h1>
    <span>or <a href="create.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">

      <?php if(!empty($error)): ?>
        <p class="error"> <?= $error ?></p>
      <?php endif; ?> 

      <input type="submit" value="Submit" name='submit'>
    </form>
  </body>
</html>