<?php
error_reporting(E_ALL ^ E_NOTICE);

include('../config/db.php');

$mealName = '';
$mealPrice = '';
$mealTime = '';

$errors = array('mealName' => '', 'mealPrice' => '', 'mealTime' => '', 'imageType' => '');
$response = array('message' => '');

if (isset($_POST['addMeal'])) {
  $mealName = $_POST['mealName'];
  $mealPrice = $_POST['mealPrice'];
  $mealTime = $_POST['mealTime'];

  $trim_mealName = trim($mealName);
  $trim_mealPrice = trim($mealPrice);
  $trim_mealTime = trim($mealTime);

  $ext = $_FILES["file"]["type"];
  $size = $_FILES["file"]["size"];
  $imageName = $_FILES["file"]["name"];

  if (empty($trim_mealName)) {
    $errors['mealName'] = 'Required*';
  }
  if (empty($trim_mealPrice)) {
    $errors['mealPrice'] = 'Required*';
  }
  if (empty($trim_mealTime)) {
    $errors['mealTime'] = 'Required*';
  }

  if ($ext === "image/jpeg" || $ext === "image/jpg" || $ext === "image/png") {
      if ($size > '5186182') {
        $errors['imageType'] = 'Images size is too large';
      } 
      if (!array_filter($errors)) {
        $mealName = mysqli_real_escape_string($conn, $trim_mealName);
        $mealPrice = mysqli_real_escape_string($conn, $trim_mealPrice);
        $mealTime = mysqli_real_escape_string($conn, $trim_mealTime);

        $rndNum = rand(111111111, 999999999)."-".$imageName;
        $tmpName = $_FILES["file"]["tmp_name"];
        $uploads_dir = '../assets/uploads';
        move_uploaded_file($tmpName , $uploads_dir.'/'.$rndNum);

        $sql = "INSERT INTO meal (meal_name, meal_price, meal_time, meal_image) VALUES ('$mealName', '$mealPrice', '$mealTime', '$rndNum')";
        $result = mysqli_query($conn, $sql);
        if ($result){
          $response['message'] =  'Meal Added Successfully';
          $mealName = '';
          $mealPrice = '';
          $mealTime = '';
        }else{
          $response['message'] = mysqli_error($conn);
        }
        mysqli_close($conn);
      }

  } else {
    $errors['imageType'] = 'Images only';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('../templates/dashboard/header_admin.php') ?>
  <main>
    <h4 class="center-align c-meal-intro">Add Meal</h4>
    <section class="c-meal-wrapper">
    <form action="meal.php" method="POST" class="c-meal-form-wrapper" enctype="multipart/form-data">
    <?php if (!$response['message']) { ?>
          <div class="c-no-response"></div>
        <?php } else if ($response['message'] === 'Meal Added Successfully'){ ?>
        <div class="c-response c-success-response">
            <p class="center-align white-text"><?php echo $response['message'] ?></p>
        </div>
        <?php } else { ?>
          <div class="c-response c-error-response">
            <p class="center-align"><?php echo $response['message'] ?></p>
          </div>
        <?php } ?>  
        <div class="c-input-field">
          <div class="c-input-field-group">
          <div class="c-input-group c-input-group-top">
            <input type="text" class="browser-default" name="mealName" id="" onkeyup="mealNameErrorHandler()" value="<?php echo htmlspecialchars($mealName) ?>" placeholder="Enter Meal Name">
            <p class="red-text" id="mealNameErrorMessage"><?php echo $errors['mealName'] ?></p>
          </div>
          <div class="c-input-group c-input-group-top">
            <input type="text" class="browser-default" name="mealPrice" id="" onkeyup="mealPriceErrorHandler()" value="<?php echo htmlspecialchars($mealPrice) ?>" placeholder="Enter Meal Price">
            <p class="red-text" id="mealPriceErrorMessage"><?php echo $errors['mealPrice'] ?></p>
          </div>
          </div>
          <div class="c-input-group">
            <input type="text" class="browser-default" name="mealTime" id="" onkeyup="mealTimeErrorHandler()" value="<?php echo htmlspecialchars($mealTime) ?>" placeholder="Enter Meal Time">
            <p class="red-text" id="mealTimeErrorMessage"><?php echo $errors['mealTime'] ?></p>
          </div>
          <div class="c-input-group">
            <input type="file" name="file" id="">
            <p class="red-text"><?php echo $errors['imageType']  ?></p>
          </div>
          <div class="button-group">
            <button type="submit" name="addMeal" class="btn btn-large c-btn-signup z-depth-0">Add meal</button>
          </div>
        </div>
      </form>
    </section>
  </main>
  <?php include('../templates/admin-footer.php'); ?>
  <script src="../assets/js/addMeal.js"></script>
</html>