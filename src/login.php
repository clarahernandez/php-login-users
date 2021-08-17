<?php
try {
  session_start();
  if (isset($_SESSION['id'])) {
    header('Location: index.php');
  }

  require '../config/database.php';

  if(isset($_POST['submit'])) {
    $message = '';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT id, name, email FROM users WHERE email = '$email' AND password = '$password';");

    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_OBJ);

    if ($user === FALSE) {
      $message = 'Invalid email or password.';
    } else {
      $_SESSION['id'] = $user->id;
      header('Location: index.php');
    }

  }
} catch (Exception $e) {
  echo $e->getMessage();
}

?>

<?php require 'partials/header.php' ?>

    <h1>Login</h1>
    <span>or <a href="create.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
      <?php endif; ?>
      <input type="submit" value="Submit" name='submit'>
    </form>
  </body>
</html>