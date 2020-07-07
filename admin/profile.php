<?php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();

  include('../config/db.php');


  $user_fullname = '';
  $user_email = '';
  $user_phoneNumber = '';
  $user_homeAddress = '';

  $id = $_SESSION['id'];


  $errors = array('fullname' => '', 'email' => '', 'phoneNumber' => '', 'homeAddress' => '');

  if(($_GET['update'] == 'profile')) {
    $sql = "SELECT fullname, email, phone_number, home_address FROM accounts WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0){
      $user = mysqli_fetch_assoc($result);
      
      $user_fullname = $user['fullname'];
      $user_email = $user['email'];
      $user_phoneNumber = $user['phone_number'];
      $user_homeAddress = $user['home_address'];
    }else{
      echo mysqli_error($conn);
    }
    mysqli_free_result($result);
    mysqli_close($conn);
  }

  if(isset($_POST['save'])) {
    $user_fullname = $_POST['fullname'];
    $user_email = $_POST['email'];
    $user_phoneNumber = $_POST['phoneNumber'];
    $user_homeAddress = $_POST['homeAddress'];

    if(empty($user_fullname)) {
      $errors['fullname'] = 'Required'; 
    }
    if(empty($user_email)) {
      $errors['email'] = 'Required'; 
    }
    if(empty($user_phoneNumber)) {
      $errors['phoneNumber'] = 'Required';
    }
    if(empty($user_homeAddress)) {
      $errors['homeAddress'] = 'Required';
    }

    if(!array_filter($errors)) {
      $fullname = mysqli_real_escape_string($conn, $fullname);
      $email = mysqli_real_escape_string($conn, $email);
      $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
      $homeAddress = mysqli_real_escape_string($conn, $homeAddress);

      $sql = "UPDATE accounts SET fullname = '$user_fullname', email = '$user_email', phone_number = '$user_phoneNumber', home_address = '$user_homeAddress' WHERE id = '$id' ";
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
  <?php include('../templates/dashboard/header_admin.php') ?>
  <main>
    <h4 class="center-align c-profile-intro">Profile</h4>
    <section class="c-signup-container">
    <form action="profile.php" method="POST">
        <div class="c-input-field">
          <div class="c-input-field-group-profile">
          <div class="c-input-field-profile-top">
            <input type="text" class="browser-default" name="fullname" id="" value="<?php echo htmlspecialchars($user_fullname) ?>" placeholder="Enter Fullname">
            <p class="red-text"><?php echo $errors['fullname'] ?></p>
          </div>
          <div class=" c-input-field-profile-top">
            <input type="text" class="browser-default" name="email" id="" value="<?php echo htmlspecialchars($user_email) ?>" placeholder="Enter Email Address">
            <p class="red-text"><?php echo $errors['email'] ?></p>
          </div>
          </div>
          <div class="c-input-group">
            <input type="text" class="browser-default" name="phoneNumber" id="" value="<?php echo htmlspecialchars($user_phoneNumber) ?>" placeholder="Enter Phone Number">
            <p class="red-text"><?php echo $errors['phoneNumber'] ?></p>
          </div>
          <div class="c-input-group">
            <textarea class="browser-default" name="homeAddress" id="" placeholder="Enter Home Address"><?php echo htmlspecialchars($user_homeAddress) ?></textarea>
            <p class="red-text"><?php echo $errors['homeAddress'] ?></p>
          </div>
          <div class="button-group">
            <button type="submit" name="save" class="btn btn-large c-btn-signup z-depth-0">Save</button>
          </div>
        </div>
      </form>
    </section>
  </main>
  <?php include('../templates/admin-footer.php') ?>
</html>