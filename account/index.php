<?php
require  '../includes/db_connect.php';
require '../includes/functions.php';

session_start();
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
            <a class="nav-link" href="<?php echo ROOT;?>">Logout</a>
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

            // Ouput Messages
            $message = (object) array(
              'login_success' => '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Login</strong> success!!!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>',
              'update_success' => '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Update</strong> success!!!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>',
              'login_error' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error</strong, username or password incorrect!!!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>',
              'update_error' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error</strong, failed to update!!!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>',
              'form_error' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Error</strong>, form has error!!!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>'
            );

            // Handle loging in
            if (isset($_POST['action']) && $_POST['action'] === 'login') {
              $username = $_POST['username'];
              $password = $_POST['password'];

              $result = loginUser($conn, $username, $password);

              if ($result !== false) {
                echo $message->login_success;

                // Start Session
                $_SESSION['userId'] = $result['ID'];
                $user = (object) $result;
              } else {
                echo $message->login_error;
                exit();
              }

            // Handle updating user details  
            } else if (isset($_POST['action']) && $_POST['action'] === 'update' && isset($_SESSION['userId'])) {
              $user = (object) getUser($conn, $_SESSION['userId']);
              $formData = $_POST;
              $formData['ID'] = $user->ID;
              $formData['profile'] = $user->profile;
              $formData['cv'] = $user->cv;

              // Update Cv
              $updated = updateProfile();
              if ($updated != false) {
                $formData['profile'] = $updated;
              }

              // Update Profile
              $updated = updateCv();
              if ($updated != false) {
                $formData['cv'] = $updated;
              }

              // Update user details in the database
              if(updateUser($conn ,$formData)) {
                echo $message->update_success;
                $user = (object) getUser($conn, $_SESSION['userId']);
              } else {
                echo $message->update_error;
              }

            // Nothing happening  
            } else {
              echo $message->form_error;
              exit();
            }
            
            ?>
          </div>
        </div>
      </div>
    </section>

    <section class="account">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-10">
            <div class="account-container">
              <div class="row">
                <div class="col-md-6">
                  <div class="account-img">
                    <img src="<?php echo ROOT;?>/uploads/profile/<?php echo $user->profile;?>" alt="" class="img-fluid">
                    <h5 class="account-name"><?php echo "$user->first_name $user->last_name";?></h5>
                    <a href="<?php echo ROOT;?>/uploads/cv/<?php echo $user->cv;?>">View CV</a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="account-form">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-lg-6">
                          <label for="first_name">First Name</label>
                          <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name;?>" placeholder="First name" required>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="last_name">Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name;?>" placeholder="Last name" required>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="profile">Profile Picture</label>
                          <input type="file" name="profile" class="form-control-file" placeholder="Profile Picture">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="cv">Curriculum Vitae</label>
                          <input type="file" name="cv" class="form-control-file" placeholder="Curriculum Vitae">
                        </div>
                        <div class="form-group col-12">
                          <label for="email">Email Address</label>
                          <input type="email" name="email" class="form-control" value="<?php echo $user->email;?>" placeholder="Email Address" required>
                        </div>
                        <div class="form-group col-12">
                          <label for="profession">Profession</label>
                          <select class="form-control" name="profession" id="profession">
                            <?php
                            
                            // Current profession selection
                            echo '<option value="' . $user->profession . '">' . $user->profession . '</option>';

                            // Get all professions
                            foreach (getProfessions() as $profession) {
                              echo '<option value="' . $profession . '">' . $profession . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group col-12">
                          <button type="submit" name="action" value="update" class="btn btn-block btn-success">Update</button>
                        </div>
                      </div> 
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <script src="../lib/jquery/jquery-3.6.0.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
  </body>
  </html>