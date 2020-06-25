<?php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  include('config/db.php');

  $id = $_SESSION['id'];
  $fullname = $_SESSION['fullname'];
  $email = $_SESSION['email'];
  $phoneNumber = $_SESSION['phoneNumber'];
  $homeAddress = $_SESSION['homeAddress'];

  $fullname = '';
  $email = '';
  $phoneNumber = '';
  $homeAddress = '';

  $errors = array('fullname' => '', 'email' => '', 'phoneNumber' => '', 'homeAddress' => '');

  if(isset($_POST['save'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $homeAddress = $_POST['homeAddress'];

    if(empty($fullname)) {
      $errors['fullname'] = 'Required'; 
    }
    if(empty($email)) {
      $errors['email'] = 'Required'; 
    }
    if(empty($phoneNumber)) {
      $errors['phoneNumber'] = 'Required';
    }
    if(empty($homeAddress)) {
      $errors['homeAddress'] = 'Required';
    }

    if(!array_filter($errors)) {
      $fullname = mysqli_real_escape_string($conn, $fullname);
      $email = mysqli_real_escape_string($conn, $email);
      $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
      $homeAddress = mysqli_real_escape_string($conn, $homeAddress);

      $sql = "UPDATE accounts SET fullname = '$fullname', email = '$email', phone_number = '$phoneNumber', home_address = '$homeAddress' WHERE id = '$id' ";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        header("Location: dashboard.php");
      } else {
        echo mysqli_error($conn);
      }
      mysqli_free_result($result);
      mysqli_close($conn);
    }

  }


?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templates/dashboard/header_client.php') ?>
  <main>
    <h2 class="center-align">Profile</h2>
    <section class="c-signup-container">
    <form action="profile.php" method="POST">
        <div class="c-input-field">
          <div class="c-input-field-group">
          <div class="c-input-group">
            <!-- <i class="fas fa-user icon"></i> -->
            <input type="text" class="browser-default" name="fullname" id="" value="<?php echo htmlspecialchars($fullname) ?>" placeholder="Enter Fullname">
            <p class="red-text"><?php echo $errors['fullname'] ?></p>
          </div>
          <div class="c-input-group">
            <!-- <i class="fas fa-envelope icon"></i> -->
            <input type="text" class="browser-default" name="email" id="" value="<?php echo htmlspecialchars($email) ?>" placeholder="Enter Email Address">
            <p class="red-text"><?php echo $errors['email'] ?></p>
          </div>
          </div>
          <div class="c-input-group">
            <!-- <i class="fas fa-envelope icon"></i> -->
            <input type="text" class="browser-default" name="phoneNumber" id="" value="<?php echo htmlspecialchars($phoneNumber) ?>" placeholder="Enter Phone Number">
            <p class="red-text"><?php echo $errors['phoneNumber'] ?></p>
          </div>
          <div class="c-input-group">
            <!-- <i class="fas fa-lock icon"></i> -->
            <textarea class="browser-default" name="homeAddress" id="" placeholder="Enter Home Address"><?php echo htmlspecialchars($homeAddress) ?></textarea>
            <!-- <input type="password" class="browser-default" name="password" id="password" value="<?php ?>" placeholder="Enter Password"> -->
            <p class="red-text"><?php echo $errors['homeAddress'] ?></p>
          </div>
          <div class="button-group">
            <button type="submit" name="save" class="btn btn-large c-btn-signup z-depth-0">Save</button>
          </div>
        </div>
      </form>
    </section>
  </main>
  <?php include('templates/footer.php'); ?>
</html>