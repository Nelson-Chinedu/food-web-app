<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

include('config/db.php');
    
$mealName = '';
$mealPrice = '';
$loggedUser = '';
$status = '';
$mealResponse = '';
$mealResponse = array('message' => '');

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
      <form method="POST" action="meal.php" class="c-meal-form-wrapper">  
        <img src="assets/images/food-1.jpg" alt="meal image">
        <p class="center-align green-text" name="mealResponse"><?php echo $mealResponse['message'] ?></p>
        <div class="c-meal-list"> 
          <h5>Meal Name</h5>
          <p>Fried Rice</p>
        </div>
        <div class="c-meal-list"> 
          <h5>Price</h5>
          <p>-N- 2,000</p>
        </div>
        <input type="hidden" value="fried-rice" name="mealName">
        <input type="hidden" value="2,000" name="price">
        <button class="btn btn-large z-depth-0 waves-effect c-btn-order" name="order" type="submit">Order</button>
        <a href="dashboard.php" class="center-align c-back">Back to dashboard</a>
      </form>
    </section>
  </main>
  <?php include('templates/footer.php'); ?>
</html>