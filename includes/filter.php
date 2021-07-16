<?php
require './db_connect.php';
require './functions.php';

function displayUsers($data ,$filter) {
  if ($data !== false) {
    foreach ($data as $user) {
        $user = (object) $user;

        echo '<div class="col-lg-2 user-container">
            <div class="card bg-light">
              <img src="../uploads/profile/' . $user->profile . '" class="card-img-top user-img" alt="...">
              <div class="card-body">
                <a href="#" class="card-title h5 user-name" onclick="openUserDialog(' . $user->ID . ')">' . $user->first_name . '<br>' . $user->last_name . '</a>
                <h6 class="user-profession">' . $user->profession . '</h6>
              </div>
            </div>
          </div>';
    }
  } else {
    echo '<div class="col">
            <h5 class="text-center text-muted">No ' . $filter . ' workers found</h5>
          </div>';
  }
}

if (isset($_POST['action']) && $_POST['action'] === 'get_users_by_filter' && isset($_POST['filter'])) {
  $filter = $_POST['filter'];

  if ($filter === '') {
    $users = getAllUsers($conn);
    displayUsers($users ,$filter);
  } else {
    $users = getUsersByProfession($conn, $filter); 
    displayUsers($users, '"' . $filter . '"');
  }

} else {
  echo '<div class="col">
            <h5 class="text-center text-muted">Profession not found</h5>
          </div>';
}

?>