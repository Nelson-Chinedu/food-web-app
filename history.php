<?php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  
  include('config/db.php');
  $id = $_SESSION['id'];

  $sql = "SELECT * FROM orders WHERE user_id = '$id' ";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templates/dashboard/header_client.php') ?>
  <main>
    <h4 class="center-align">History</h4>
    <section class="c-order-wrapper">
      <?php if($user) { ?>
        <table class="responsive striped">
          <thead>
            <tr>
              <th>Meal Name</th>
              <th>Meal Price</th>
              <th>Date</th>
            </tr>    
          </thead>
          <tbody>
          <?php foreach($user as $userRecord) { ?>
            <tr>
              <td><?php echo $userRecord['meal_name'] ?></td>
              <td><?php echo $userRecord['price'] ?></td>
              <td><?php echo $userRecord['created_at'] ?></td>
            </tr>
            <?php } ?>  
          </tbody>  
        </table>
      <?php } else { ?>
          <h5 class="center-align"><?php echo 'No Record Found' ?></h5>
      <?php } ?>  
    </section>
  </main>
  <?php include('templates/footer.php'); ?>
</html>