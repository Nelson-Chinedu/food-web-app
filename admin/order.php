<?php
error_reporting(E_ALL ^ E_NOTICE);

include('../config/db.php');

$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('../templates/dashboard/header_admin.php') ?>
  <main>
  <h4 class="center-align">Order(s)</h4>   
    <section class="c-order-wrapper">
    <?php if($user) { ?>
    <table class="striped responsive">
      <thead>
        <tr>
          <th>Meal Name</th>
          <th>Meal Price</th>
          <th>Date</th>
          <th colspan="2">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($user as $userOrder) { ?>
        <?php if($userOrder['meal_status'] === 'pending'){ ?>
          <?php $mealStatus = 'Unverified'; ?>
        <?php } ?>
          <tr>
            <td><?php echo $userOrder['meal_name'] ?></td>
            <td><?php echo $userOrder['price'] ?></td>
            <td><?php echo $userOrder['created_at'] ?></td>
            <td><?php echo $mealStatus ?></td>
          </tr>
        <?php } ?>  
      </tbody>  
    </table>
    <?php } else { ?>
      <h5 class="center-align"><?php echo 'No Order Found' ?></h5>
    <?php } ?>
    </section>
  </main>
  <?php include('../templates/footer.php'); ?>
</html>