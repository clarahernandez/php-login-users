<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
  }
  require 'database.php';

  $message = '';

  $stmt = $db->query("SELECT * FROM users;");
  $users = [];
  if($stmt != false){
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }  else {
    $message = "No se pudo obtener los datos.";
  }
?>

<?php require 'partials/header.php' ?>


  <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?> 
      <h3>List of users </h3>
      <a href="create.php">Add new user</a>

      <table>
        <tr>
          <td>Id</td>
          <td>Name</td>
          <td>Email</td>
          <td>Actions</td>
        </tr>
        <?php 
          foreach ($users as $user) {
            ?>
            <tr>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo $user['name']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td>
                <a href="show.php?id=<?php echo $user['id']; ?>">Show/Update</a> | 
                <a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a></td>
            </tr>
            <?php
          }
        ?>
      </table>

  </body>
</html>