<?php 
  error_reporting(E_ALL ^ E_NOTICE);

  session_start();

  $fullname = $_SESSION['fullname'];
  $email = $_SESSION['email'];
  $phoneNumber = $_SESSION['phoneNumber'];
  $homeAddress = $_SESSION['homeAddress'];

  $error = array('message' => '');
  if (!isset($fullname)) {
    header("Location: auth/login.php");
  }
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/client.css">
  <title>Foodie Fresh</title>
</head>
<body>
<header>
  <div class="wrapper">
  <nav class="z-depth-0">
    <div class="nav-wrapper c-bottom-nav">
      <a href="#!" class="brand-logo">Foodie Fresh</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><span class="c-logged-user">Welcome <?php echo htmlspecialchars($fullname) ?></span></li>
      </ul>
    </div>
  </nav>
  </div>
  <ul id="mobile-demo" class="sidenav sidenav-fixed invesible-top">
    <li><div class="user-view">
      <a href="#user"><img class="circle" src="assets/images/avatar.png" alt="profile-image"></a>
      <a href="#name"><span class="black-text center-align name"><?php echo htmlspecialchars($fullname) ?></span></a>
      <a href="#email"><span class="black-text center-align email"><?php echo htmlspecialchars($email) ?></span></a>
    </div></li>
    <li><div class="divider"></div></li>
    <li><a href="#!" class="text-lighten-4"><i class="material-icons">dashboard</i>Main Menu</a></li>
    <li><div class="divider"></div></li>
    <li><a class="c-sidenav-link grey-text text-darken-5" href="./dashboard.php"><i class="material-icons">home</i>Dashboard</a></li>
    <li><a class="c-sidenav-link grey-text text-darken-5" href="order.php"><i class="material-icons">local_grocery_store</i>Orders</a></li>
    <li><a class="c-sidenav-link grey-text text-darken-5" href="history.php"><i class="material-icons">history</i>History</a></li>
    <li><a class="c-sidenav-link grey-text text-darken-5" href="#!"><i class="material-icons">notifications</i>Notification <span class="new badge">4</span></a></li>
    <li><div class="divider"></div></li>
    <li><a href="#!"><i class="material-icons">settings</i>Settings</a></li>
    <li><div class="divider"></div></li>
    <li><a class="c-sidenav-link grey-text text-darken-5" href="./profile.php?update=profile"><i class="material-icons">account_circle</i>Profile</a></li>
    <li><a class="c-sidenav-link grey-text text-darken-5" href="#!"><i class="material-icons">help</i>Help</a></li>
    <li name="logout"><a class="c-sidenav-link grey-text text-darken-5" href="logout.php"><i class="material-icons">arrow_back</i>Logout</a></li>
  </ul>
  
</header>