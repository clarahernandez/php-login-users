<?php

  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
  }

  require '../config/database.php';

  try {
    //Session validation.
    if (!isset($_GET['id'])) {
      header('Location: index.php');
    }

    //We get the messages from the query if exists.
    if (isset($_GET['error'])) {
      $success = '';
      $error = $_GET['error'];
    } elseif (isset($_GET['success'])){
      $error = '';
      $success = $_GET['success'];
    } else {
      $error = '';
      $success = '';
    }

    $id = $_GET['id'];

    //We search the user form the database.
    $stmt = $db->prepare("SELECT id,name,email FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);

  } catch (Exception $e) {
    echo $e->getMessage();
  }
  
?>

<?php require 'partials/header.php' ?>

    <?php if(!empty($sucess)): ?>
      <p class="success"> <?= $success ?></p>
    <?php endif; ?> 
    <?php if(!empty($error)): ?>
      <p class="error"> <?= $error ?></p>
    <?php endif; ?> 

    <h3>User</h3>
    <form action="update.php" method="POST">
      <input name="id" type="hidden" value="<?php echo $user->id; ?>">
      <input name="name" type="text" value="<?php echo $user->name; ?>">
      <input name="email" type="text" value="<?php echo $user->email; ?>">
      <input type="submit" value="Submit" name="update">
    </form>
  </body>
</html>