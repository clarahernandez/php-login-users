<?php
  session_start();
  
  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
  }
  require '../config/database.php';

  $error = '';
  $success = '';

  //Get the list of users from the database.
  $stmt = $db->query("SELECT * FROM users;");
  $users = [];
  if($stmt != false){
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }  else {
    $error = "Error getting the data.";
  }
  
  //We get the messages from the query.
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
?>

<?php require 'partials/header.php' ?>


      <?php if(!empty($error)): ?>
          <p class="error"> <?= $error ?></p>
      <?php endif; ?> 

      <?php if(!empty($success)): ?>
          <p class="success"> <?= $success ?></p>
      <?php endif; ?> 

      <div class="container1">
        <span class="title">List of users </h3>
        <a href="create.php" class="button-add">Add +</a>
      </div>
      <table>
        <tr class="table-header">
          <td>Id</td>
          <td>Name</td>
          <td>Email</td>
          <td>Actions</td>
        </tr>
        <?php 
          foreach ($users as $user) {
            ?>
            <tr>
              <td class="td"><?php echo $user['id']; ?></td>
              <td><?php echo $user['name']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td>
                <a class="button-show" href="show.php?id=<?php echo $user['id']; ?>">Show/Update</a>  
                <a class="button-delete" href="delete.php?id=<?php echo $user['id']; ?>">Delete</a></td>
            </tr>
            <?php
          }
        ?>
      </table>

  </body>
</html>