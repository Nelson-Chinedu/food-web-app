<footer class="page-footer">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Get the app on</h5>
        <div class="row">
          <a href="#" class="col s12 m6 l3"><img src="assets/images/apple.svg" alt=""></a>
          <a href="#" class="col s12 m6 l3 offset-l2"><img src="assets/images/google-play.svg" alt=""></a>
        </div>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Menus</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="index.php">Home</a></li>
          <li><a class="grey-text text-lighten-3" href="#">About Us</a></li>
          <li><a class="grey-text text-lighten-3" href="#">How It Works</a></li>
          <li><a class="grey-text text-lighten-3" href="#">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      &copy; <span id="showYear"></span> - All Rights Reserved
      <a class="grey-text text-lighten-4 right" href="https://nelsondev.netlify.app/" target="_blank">Made by Nelson</a>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./assets/js/footer.js"></script>
<script>
  $(document).ready(function(){
    $('.sidenav').sidenav();
    $('.pushpin-demo-nav').pushpin({ 
      top: $('.pushpin-demo-nav').offset().top 
    });
  });
</script>
</body>