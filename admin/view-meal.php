<?php

error_reporting(E_ALL ^ E_NOTICE);
  
include('../config/db.php');

$mealName = '';
$mealPrice = '';
$mealTime = '';
$mealImage = '';


$response = array('message' => '');

$sql = "SELECT * FROM meal WHERE id = '".$_GET['id']."'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
  $meal = mysqli_fetch_assoc($result);
  $mealName = $meal['meal_name'];
  $mealPrice = $meal['meal_price'];
  $mealTime = $meal['meal_time'];
  $mealImage = $meal['meal_image'];
}

$id = $_GET['id'];

if(isset($_POST['delete'])) {
  $getMealId = $_POST['mealId'];
  
  $sql = "DELETE FROM meal WHERE id = '$getMealId'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
      $response['message'] = 'Meal has been deleted successfully';
  } else {
      echo mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <?php include('../templates/dashboard/header_admin.php') ?>
  <main>
    <h4 class="center-align">View Meal</h4>
    <section class="c-meal-wrapper">
      <form method="POST" action="view-meal.php?action=view&id=<?php echo $id?>" class="c-meal-form-wrapper">  
        <img src="../assets/uploads/<?php echo $mealImage ?>" alt="meal image">
        <?php if (!$meal) { ?>
          <p class="center-align red-text"><?php echo $response['message'] = '' ?></p>
        <?php } else { ?>
          <p class="center-align red-text"><?php echo $response['message'] ?></p>
        <?php } ?>
        <?php if($meal) { ?>
          <div class="c-meal-list"> 
            <h5>Meal Name</h5>
            <p><?php echo $mealName ?></p>
          </div>
          <div class="c-meal-list"> 
            <h5>Price</h5>
            <p><?php echo $mealPrice ?></p>
          </div>
          <input type="hidden" value="<?php echo $id ?>" name="mealId">
          <button class="btn btn-large z-depth-0 waves-effect c-btn-update" name="update">Update Meal</button>
          <button class="btn btn-large z-depth-0 waves-effect red lighten-3 c-btn-delete" name="delete">Delete Meal</button>
          <a href="dashboard.php" class="center-align c-back">Back to dashboard</a>
        <?php } else { ?>
          <h5><?php echo 'Meal not found' ?></h5>
        <?php } ?>  
      </form>
    </section>
  </main>
  <?php include('../templates/footer.php') ?>
</html>