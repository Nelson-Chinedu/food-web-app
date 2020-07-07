<?php
  error_reporting(E_ALL ^ E_NOTICE);

include('config/db.php');

$sql = "SELECT * FROM meal";
$result = mysqli_query($conn, $sql);
$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>
  <main class="c-main-meal-wrapper">
    <section>
      <div class="c-meals-search-container">
        <div class="c-meals-nav">
          <h4 class="black-text c-meal-title">OUR MEALS</h4>
        </div>
      </div>
    </section>
    <section>
      <div class="c-meal-container">
        <div class="row">
          <?php if ($meals){ ?>
            <?php foreach($meals as $meal) { ?>
              <a href="auth/login.php">
                <div class="col s12 m3 l3">
                  <div class="card c-meal-card-wrapper">
                    <div class="card-image">
                      <img src="assets/uploads/<?php echo $meal['meal_image'] ?>" alt="Photo of meal">
                    </div>
                    <div class="card-content">
                      <p><?php echo $meal['meal_name']?></p>
                      <div class="c-chip">
                        <div class="c-chip-container">
                          <span class="chip"><?php echo $meal['meal_price'] ?></span>
                        </div>
                        <div class="c-chip-hour">
                          <span><i class="material-icons left">access_time</i><?php echo $meal['meal_time'] ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            <?php } ?>
          <?php } else{ ?>
            <h5 class="center-align"><?php echo "No Meals Added. Please Check Back Later" ?></h5>
          <?php } ?>  
        </div>
        <div class="row center-align">
          <a href="#" class="btn btn-large c-btn-load-more">Load More Meals</a>
        </div>
      </div>
    </section>
    <section>
      <div class="c-popular-meal">
        <h4 class="black-text c-popular-meal-title">POPULAR</h4>
        <div class="row">
          <?php if ($meals){ ?>
            <?php foreach($meals as $meal) { ?>
              <a href="auth/login.php">
                <div class="col s12 m3 l3">
                  <div class="card c-meal-card-wrapper">
                    <div class="card-image">
                      <img src="assets/uploads/<?php echo $meal['meal_image'] ?>" alt="Photo of meal">
                    </div>
                    <div class="card-content">
                      <p><?php echo $meal['meal_name']?></p>
                      <div class="c-chip">
                        <div class="c-chip-container">
                          <span class="chip"><?php echo $meal['meal_price'] ?></span>
                        </div>
                        <div class="c-chip-hour">
                          <span><i class="material-icons left">access_time</i><?php echo $meal['meal_time'] ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            <?php } ?>
          <?php } else{ ?>
            <h5 class="center-align"><?php echo "No Popular Meals Found. Please Check Back Later" ?></h5>
          <?php } ?>  
        </div>
      </div>
    </section>
  </main>
<?php include('templates/footer.php') ?>
</html>