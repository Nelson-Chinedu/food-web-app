<?php
  include('../config/db.php');
  
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();

  $email = '';
  $password = '';

  $errors = array('email' => '', 'password' => '');
  $response = array('message' => '');


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

      if ($user['role'] === 'client'){
        header("Location: ../dashboard.php");
      }else if ($user['role'] === 'admin' || $user['role'] === 'super'){
         header("Location: ../admin/dashboard.php"); 
      } else {
        header("Location: ../auth/login.php");
      }
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
  <title>Fresh Foodie</title>
</head>
<body>
  <main class="c-login-wrapper">
    <h4 class="center-align"><a href="../index.php">Fresh Foodie</a></h4>
    <section class="c-login-container">
      <form action="login.php" method="POST">
        <?php if ($response['message']) { ?>
          <div class="c-error-response">
              <p class="center-align white-text"><?php echo $response['message'] ?></p>
          </div>
          <?php } ?>
        <div class="c-input-field">
          <div class="c-input-group">
            <i class="fas fa-envelope icon"></i>
            <input type="text" class="browser-default" name="email" id="email" onkeyup="emailErrorHandler()" value="<?php echo $email ?>" placeholder="Enter Email Address">
            <p class="red-text" id="emailErrorMessage"><?php echo $errors['email'] ?></p>
          </div>
          <div class="c-input-group">
            <i class="fas fa-lock icon"></i>
            <input type="password" class="browser-default" name="password" id="password" onkeyup="passwordErrorHandler()" value="<?php echo $password ?>" placeholder="Enter Password">
            <p class="red-text" id="emailErrorMessage"><?php echo $errors['password'] ?></p>
          </div>
          <div class="c-forgot-password">
            <a href="">Forgot Password</a>
          </div>
          <div class="button-group">
            <button type="submit" name="login" class="btn btn-large c-btn-login z-depth-0">Login</button>
          </div>
        </div>
        <div class="c-login-optional">
          <p class="center-align">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
      </form>
    </section>
  </main>
  <script src="../assets/js/login.js"></script>
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
          s1.async=true;
          s1.src='https://embed.tawk.to/5f05f3fe5b59f94722ba5a6e/default';
          s1.charset='UTF-8';
          s1.setAttribute('crossorigin','*');
          s0.parentNode.insertBefore(s1,s0);
      })();
  </script>
  </body>
</html>