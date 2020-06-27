<?php
  error_reporting(E_ALL ^ E_NOTICE);

include('config/db.php');

$sql = "SELECT * FROM meal";
$result = mysqli_query($conn, $sql);
$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templates/dashboard/header_client.php') ?>
  <main>
  <section class="">
    <div class="c-meal-container">
      <div class="row">
        <?php if ($meals){ ?>
          <?php foreach($meals as $meal) { ?>
            <a href="view-meal.php?action=view&id=<?php echo $meal['id']?>">
              <div class="col s12 m4 l4 c-meal-card">
                <div class="card">
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
    </div>
  </section>
  </main>
  <?php include('templates/client-footer.php') ?>
</html>