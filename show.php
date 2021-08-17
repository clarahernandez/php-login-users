<?php

  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
  }

  require 'database.php';

  try {
    if (!isset($_GET['id'])) {
      header('Location: index.php');
    }

    if (isset($_GET['message'])) {
      $message = $_GET['message'];
    } else {
      $message = '';
    }

    $id = $_GET['id'];

    
    
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  
  $stmt = $db->prepare("SELECT id,name,email FROM users WHERE id = ?");
  $stmt->execute([$id]);
  $user = $stmt->fetch(PDO::FETCH_OBJ);
?>

<?php require 'partials/header.php' ?>


    
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
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