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
  <main>
    <section>
      <div class="c-meals-search-container">
        <div class="c-meals-nav">
          <h4 class="red-text">OUR MEALS</h4>
        </div>
        <div class="c-search-nav">
          <form>
              <div class="input-field col s6">
                <i class="material-icons prefix">search</i>
                <input id="search" type="tel" class="validate">
                <label for="search">Search</label>
              </div>
          </form>
        </div>
      </div>
      <div class="c-meals-menu pushpin-demo-nav">
        <ul class="">
          <li class="c-all-menu"><a class="white-text" href="#">All (170)</a></li>
          <li><a href="#">Break Fast (23)</a></li>
          <li><a href="#">Launch (41)</a></li>
          <li><a href="#">Drinks (53)</a></li>
          <li><a href="#">Deserts (170)</a></li>
          <li><a href="#">Fast Food (170)</a></li>
        </ul>
      </div>
    </section>
    <section>
      <div class="c-meal-container">
        <div class="row">
          <?php if ($meals){ ?>
            <?php foreach($meals as $meal) { ?>
              <a href="auth/login.php">
                <div class="col s12 m4 l4">
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
    <section>
      <div class="c-popular-meal">
        <h4>POPULAR</h4>
      </div>
    </section>
  </main>
<?php include('templates/footer.php') ?>
</html>