<?php
// error_reporting(E_ALL ^ E_NOTICE);
// session_start();

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
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($user as $userOrder) { ?>
            <tr>
              <td><?php echo $userOrder['meal_name'] ?></td>
              <td><?php echo $userOrder['price'] ?></td>
              <td><?php echo $userOrder['created_at'] ?></td>
              <td class="btn-action"><a class="btn lighten-2"><i class="material-icons left">check_circle</i>Request Order</a></td>
              <td class="btn-action"><a href="order.php?action=cancel&id=<?php echo $userOrder['id']?>" class="btn red lighten-2"><i class="material-icons left">cancel</i>Cancel Order</a></td>
            </tr>
            <?php } ?>  
          </tbody>  
        </table>
      <?php } else { ?>
          <h5 class="center-align"><?php echo 'No Order Found' ?></h5>
      <?php } ?>
      </tbody>
    </table>
    </section>
  </main>
  <?php include('../templates/footer.php'); ?>
</html>