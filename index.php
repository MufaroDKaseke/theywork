<?php
require  './includes/db_connect.php';
require './includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TheyWork</title>
  <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./lib/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

  <header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
      <a href="<?php echo ROOT;?>" class="navbar-brand">TheyWork</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNav" aria-controls="headerNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="headerNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT;?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo ROOT;?>/explore/">Explore</a>
          </li>
          <li class="nav-item">
            <a id="loginBtn" class="nav-link" onclick="openDialog('login-dialog')">Login</a>
          </li>
          <li class="nav-item">
            <a id="signupBtn" class="nav-link" onclick="openDialog('signup-dialog')">Signup</a>
          </li>
        </ul>
      </div>

    </nav>
  </header>

  <section class="results">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <?php
          require './includes/singup.php';
          ?>
        </div>
      </div>
    </div>
  </section>

  <section class="welcome">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-7">
          <img src="./img/work-profile.png" alt="Work Picture" class="img-fluid welcome-img">
        </div>
        <div class="col-md-5">
          <h1 class="display-1 welcome-heading"><span>They</span> Work</h1>
          <h5 class="welcome-paragraph">Loook for work from the comfort of your home</h5>
        </div>
      </div>
    </div>
  </section>

  <?php
  require './signup-modal.php';
  require './login-modal.php';
  ?>
  

  <script src="./lib/jquery/jquery-3.6.0.min.js"></script>
  <script src="./lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./js/main.js"></script>
</body>
</html>