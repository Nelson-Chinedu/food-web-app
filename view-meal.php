<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

include('config/db.php');

$id = '';
$mealImage = '';
$mealTime = '';
$mealName = '';
$mealPrice = '';
$loggedUser = '';
$status = '';
$mealResponse = '';
$mealResponse = array('message' => '');

if($_GET['action'] == 'view'){
  $id = $_GET['id'];

  $sql = "SELECT meal_image, meal_name, meal_price, meal_time FROM meal WHERE id = '$id' ";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if ($count > 0) {
    $meal = mysqli_fetch_assoc($result);
    
    $mealImage = $meal['meal_image'];
    $mealName = $meal['meal_name'];
    $mealPrice = $meal['meal_price'];
    $mealTime = $meal['meal_time'];
  } else {
    echo 'nope';
  }
}

if (isset($_POST['order'])){
  $mealName = $_POST['mealName'];
  $mealPrice = $_POST['price'];
  $loggedUser = $_SESSION['id'];
  $status = 'pending';

  $sql = "INSERT INTO orders(meal_name, price, meal_status, user_id) VALUES ('$mealName', '$mealPrice', '$status', '$loggedUser')";
  $result = mysqli_query($conn, $sql);

  if ($result){
    $mealResponse['message'] = 'Your order have been booked';
  } else {
    echo mysqli_error($conn);
  }
  mysqli_close($conn);
}
  

?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templates/dashboard/header_client.php') ?>
  <main>
    <h4 class="center-align">View Meal</h4>
    <section class="c-meal-wrapper">
      <form method="POST" action="view-meal.php?action=view&id=<?php echo $id ?>" class="c-meal-form-wrapper">  
        <img src="assets/images/food-1.jpg" alt="meal image">
        <p class="center-align green-text" name="mealResponse"><?php echo $mealResponse['message'] ?></p>
        <div class="c-meal-list"> 
          <h5>Meal Name</h5>
          <p><?php echo $mealName ?></p>
        </div>
        <div class="c-meal-list"> 
          <h5>Price</h5>
          <p><?php echo $mealPrice ?></p>
        </div>
        <input type="hidden" value="<?php echo $mealName ?>" name="mealName">
        <input type="hidden" value="<?php echo $mealPrice ?>" name="price">
        <button class="btn btn-large z-depth-0 waves-effect c-btn-order" name="order" type="submit">Order</button>
        <a href="dashboard.php" class="center-align c-back">Back to dashboard</a>
      </form>
    </section>
  </main>
  <?php include('templates/footer.php'); ?>
</html>