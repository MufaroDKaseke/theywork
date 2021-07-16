<?php
require  '../includes/db_connect.php';
require '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TheyWork</title>
  <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
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
          <li class="nav-item">
            <a class="nav-link" href="<?php echo ROOT;?>">Home </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT;?>/explore/">Explore <span class="sr-only">(current)</span></a>
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

    <section class="actions py-2">
      <div class="container-fluid">
        <div class="row justify-content-end">
          <div class="col">
            <div class="actions-container">
              <span class="d-inline"><?php echo countUsers($conn);?> (total users)</span>
              <div class="filters">
                <form action="">
                  <div class="profession-filter input-group">
                    <div class="input-group-prepend">
                      <i class="fa fa-user"></i>
                    </div>
                    <select id="profession-dropdown" name="profession-filter" class="profession-dropdown form-control" id="exampleFormControlSelect1">
                      <option value="">All</option>
                      <?php
                      foreach (getProfessions() as $profession) {
                        echo '<option value="' . $profession . '">' . $profession . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </form>
                
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>


    <section class="explore">
      <div class="container-fluid">
        <hr>
        <div class="row">

          <?php

          $users = getAllUsers($conn);

          foreach ($users as $user) {
            $user = (object) $user;

            echo '<div class="col-lg-2 user-container">
                    <div class="card bg-light">
                      <img src="' . ROOT . '/uploads/profile/' . $user->profile . '" class="card-img-top user-img" alt="...">
                      <div class="card-body">
                        <a href="#" class="card-title h5 user-name" onclick="openUserDialog(' . $user->ID . ')">' . $user->first_name . '<br>' . $user->last_name . '</a>
                        <h6 class="user-profession">' . $user->profession . '</h6>
                      </div>
                    </div>
                  </div>';   
          }
          ?>

          <!--<div class="col-lg-2 user-container">
            <div class="card bg-light">
              <img src="../img/avatar.png" class="card-img-top user-img" alt="...">
              <div class="card-body">
                <a href="#" class="card-title h5 user-name" onclick="openUserDialog(323)">Taurai<br>d</a>
                <h6 class="user-profession">Systems Engineer</h6>
              </div>
            </div>
          </div>-->

        </div>
      </div>
    </section>


    <!-- User Modal -->
    <div class="user-dialog">
      <a id="close-dialog"  onclick="closeDialog('user-dialog')">&times;</a>
      <div class="dialog-container">
        <!-- User Data -->
        <div class="row">
          <div class="col-lg-6">
            <div class="user-dialog-img">
              <img src="../img/avatar.png" alt="User Profile">
              <h4>Name Surname</h4>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="user-dialog-details">
              <h4>Names's Details</h4>
              <ul>
                <li><b>Profession :</b> Engineering</li>
                <li><b>Email : </b>example@example.com</li>
              </ul>
              <a href="#" class="btn btn-view-cv btn-sm btn-success">View CV</a>
              <a href="#" class="btn btn-download-cv btn-sm btn-success">Download CV</a>
            </div>
          </div>
        </div>
        <!-- End of user data -->
      </div>
    </div>

    <?php
    require '../signup-modal.php';
    require '../login-modal.php';
    ?>

  <script src="../lib/jquery/jquery-3.6.0.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/main.js"></script>
      <script>


        
      // Select for filter
      const profFilter = document.querySelector("#profession-dropdown");
      
      // Filter the worker profiles
      profFilter.addEventListener('change', () => {
        let filter = $(profFilter).val();
        let usersContainer = document.querySelector(".explore > .container-fluid > .row");

          $.ajax({
            url: '../includes/filter.php',
            type: 'POST',
            dataType: 'html',
            data: {action: 'get_users_by_filter', filter: filter},
            beforeSend: function() {
              
            },
            success: function(data) {
              usersContainer.innerHTML = data;
            },
            error: function(e) {
              console.log(e);
            }, 
            complete: function() {
           }
          });
      });


      // Open the user dialog
      function openUserDialog(userId) {
        let dialogContainer = document.querySelector('.user-dialog .dialog-container');

        $.ajax({
          url: '../includes/user-dialog.php',
          type: 'POST',
          dataType: 'html',
          data: {action: 'get_user', userId: userId},
          beforeSend: function() {
            
          },
          success: function(data) {
            dialogContainer.innerHTML = data;
          },
          error: function(e) {
            console.log(e);
          }, 
          complete: function() {
         }
        });
        
        openDialog('user-dialog');
      }
  
    </script>
</body>
</html>