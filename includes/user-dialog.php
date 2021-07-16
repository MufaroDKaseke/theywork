<?php
require './db_connect.php';
require './functions.php';

if (isset($_POST['action']) && $_POST['action'] === 'get_user' && isset($_POST['userId'])) {
  $userId = $_POST['userId'];

  $user = getUser($conn, $userId);

  if($user !== false) {
    $user = (object) $user;
    echo '<div class="row">
        <div class="col-lg-6">
          <div class="user-dialog-img">
            <img src="../uploads/profile/' .$user->profile . '" alt="User Profile">
            <h4>' . $user->first_name . ' '. $user->last_name . '</h4>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="user-dialog-details">
            <h4>' . $user->first_name . '\'s Details</h4>
            <ul>
              <li><b>Profession : </b>' . $user->profession . '</li>
              <li><b>Email : </b>' . $user->email . '</li>
            </ul>
            <a href="../uploads/cv/' .$user->cv . '" target="_blank" class="btn btn-view-cv btn-sm btn-success">View Cv <i class="fa fa-download"></i></a>
            <a href="../uploads/cv/' . $user->cv . '" class="btn btn-download-cv btn-sm btn-success" downlaod="">Download Cv <i class="fa fa-download"></i></a>
          </div>
        </div>
      </div>';  
  } else {
    echo '<div class="row align-items-center justify-content-center">
          <div class="col">
            <h3 class="text-center">User not found</h3>
          </div>
        </div>';
  }
} else {
  echo '<div class="row align-items-center justify-content-center">
          <div class="col">
            <h3 class="text-center">User not entered</h3>
          </div>
        </div>';
}

?>