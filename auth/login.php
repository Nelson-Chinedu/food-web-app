<?php
  include('../config/db.php');
  session_start();

  $email = '';
  $password = '';

  $errors = array('email' => '', 'password' => '');
  $response = array('message' => '');

  if ($_SESSION['message']) {
    $response['message'] = $_SESSION['message'];
  }
  
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email)) {
    $errors['email'] = 'Required*';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Enter a valid email address';
  }

  if (empty($password)) {
    $errors['password'] = 'Required*';
  }

  if (!array_filter($errors)){
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $hashed_password = md5($password);

    $sql = "SELECT * FROM accounts WHERE email = '$email' AND password = '$hashed_password' ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      $user = mysqli_fetch_assoc($result);
      print_r($user);
      $_SESSION['id'] = $user['id'];
      $_SESSION['fullname'] = $user['fullname'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['phoneNumber'] = $user['phone_number'];
      $_SESSION['homeAddress'] = $user['home_address'];
      header("Location: ../dashboard.php");
      $email = '';
      $password = '';
    } else {
      $response['message'] = 'Wrong Email Address or Password';
    }
    mysqli_free_result($result);
    mysqli_close($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/login.css">
  <title>Document</title>
</head>
<body>
  <main>
    <section class="c-login-container">
      <form action="login.php" method="POST">
        <?php if ($response['message']) { ?>
          <div class="c-error-response">
              <p class="center-align"><?php echo $response['message'] ?></p>
          </div>
          <?php } ?>
        <div class="c-input-field">
          <div class="c-input-group">
            <i class="fas fa-envelope icon"></i>
            <input type="text" class="browser-default" name="email" id="email" value="<?php echo $email ?>" placeholder="Enter Email Address">
            <p class="red-text"><?php echo $errors['email'] ?></p>
          </div>
          <div class="c-input-group">
            <i class="fas fa-lock icon"></i>
            <input type="password" class="browser-default" name="password" id="password" value="<?php echo $password ?>" placeholder="Enter Password">
            <p class="red-text"><?php echo $errors['password'] ?></p>
          </div>
          <div class="c-forgot-password">
            <a href="">Forgot Password</a>
          </div>
          <div class="button-group">
            <button type="submit" name="login" class="btn btn-large c-btn-login z-depth-0">Login</button>
          </div>
        </div>
        <div class="c-signup-optional">
          <p>Don't have an account?</p>
          <a href="signup.php">Sign Up</a>
        </div>
      </form>
    </section>
  </main>
  
 <?php include('../templates/footer.php') ?>
</html>