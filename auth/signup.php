<?php
  include('../config/db.php');

  $fullname = '';
  $email = '';
  $password = '';

  $errors = array('fullname' => '', 'email' => '', 'password' => '');
  $response = array('message' => '');

  if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($fullname)) {
      $errors['fullname'] = 'Required*';
    }
    if(empty($email)) {
      $errors['email'] = 'Required*';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] = 'Enter a valid email address';
    }

    if (empty($password)) {
      $errors['password'] = 'Required*';
    } else if (strlen($password) < 8){
      $errors['password'] = 'Minimum of 8 characters';
    }

    if (!array_filter($errors)) {
      $fullname = mysqli_real_escape_string($conn, $fullname);
      $email = mysqli_real_escape_string($conn, $email);
      $password = mysqli_real_escape_string($conn, $password);
      $hashed_password = md5($password);

      $sql = "INSERT INTO accounts(fullname, email, password) VALUES('$fullname', '$email', '$hashed_password')";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        $response['message'] = 'Account Created Successfully. Please Login';
        $fullname = '';
        $email = '';
        $password = '';
      } else {
        $response['message'] =  mysqli_error($conn);
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
  <link rel="stylesheet" href="../assets/css/signup.css">
  <title>Document</title>
</head>
<body>
  <main>
    <section class="c-signup-container">
      <form action="signup.php" method="POST">
        
        <?php if (!$response['message']) { ?>
          <div class="c-no-response"></div>
        <?php } else if ($response['message'] === 'Account Created Successfully. Please Login'){ ?>
        <div class="c-response c-success-response">
            <p class="center-align"><?php echo $response['message'] ?></p>
        </div>
        <?php } else { ?>
          <div class="c-response c-error-response">
            <p class="center-align"><?php echo $response['message'] ?></p>
          </div>
        <?php } ?>
        <div class="c-input-field">
          <div class="c-input-group">
            <i class="fas fa-user icon"></i>
            <input type="text" class="browser-default" name="fullname" id="fullnamee" value="<?php echo $fullname ?>" placeholder="Enter Fullname">
            <p class="red-text"><?php echo $errors['fullname']; ?></p>
          </div>
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
            <button type="submit" name="signup" class="btn btn-large c-btn-signup z-depth-0">Signup</button>
          </div>
        </div>
        <div class="c-signup-optional">
          <p>Already have an account?</p>
          <a href="login.php">Login</a>
        </div>
      </form>
    </section>
  </main>
  
 <?php include('../templates/footer.php') ?>
</html>