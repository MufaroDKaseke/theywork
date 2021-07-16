<?php


// Config

define('ROOT', 'http://' . $_SERVER['SERVER_NAME'] . '/TheyWork');
define("PROFESSIONS", array('Design', 'Engineering', 'Manufacturing', 'Art'));

// Return all profession
function getProfessions() {
  return PROFESSIONS;
}


// Upload Cv
function uploadCv($uploadsDir) { 
  $cv = $_FILES['cv'];

  if ($cv['error']) {
    die("CV file has error!!!");
  } else {
    $filename = basename($cv['name']);
    $destination = $uploadsDir . '/' . $cv['name'];
    try {
      move_uploaded_file($cv['tmp_name'], $destination);
      return $cv['name'];
    } catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
      return false;
    }
  }
}

// Upload Profile Photo
function uploadProfile($uploadsDir) { 
  $profile = $_FILES['profile'];

  if ($profile['error']) {
    var_dump($profile);
    die("Picture file has error!!!");
  } else {
    $filename = basename($profile['name']);
    $destination = $uploadsDir . '/' . $profile['name'];
    try {
      move_uploaded_file($profile['tmp_name'], $destination);
      return $profile['name'];
    } catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
      return false;
    }
  }
}

// Enter details of new user to database
function signupUser($conn ,$data) {

  $stmt = mysqli_prepare($conn, "INSERT INTO users VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 'avatar.png', CURRENT_TIMESTAMP)");
  mysqli_stmt_bind_param($stmt, 'sssssss', $data['first_name'], $data['last_name'], $data['email'], $data['profession'], $data['cv'], $data['username'], $data['password']);

  if(mysqli_stmt_execute($stmt)) {
    return true;
  } else {
    return false;
  }
  mysqli_stmt_close($stmt);
}

// Login a user
function loginUser($conn ,$username ,$password) {

  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($user = mysqli_fetch_assoc($result)) {
      if (password_verify($username, $user['username']) && password_verify($password, $user['password'])) {
        return $user;
      }  
    }
  } 
  return false;
}

// Get user data
function getUser($conn, $userId) {
  $sql = "SELECT * FROM users WHERE ID=$userId";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
    return $user;
  }
  return false;
}

function getAllUsers($conn) {
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);

  $users = [];

  if (mysqli_num_rows($result) > 0) {
    while($user = mysqli_fetch_assoc($result)) {
      $users[$user['ID']] = $user;
    }
    return $users;
  } 
  return false;
}

function countUsers($conn) {
  return count(getAllUsers($conn));
}

function getUsersByProfession($conn, $profession) {
  $sql = "SELECT * FROM users WHERE profession='$profession'";
  $result = mysqli_query($conn, $sql);

  $users = [];

  if (mysqli_num_rows($result) > 0) {
    while($user = mysqli_fetch_assoc($result)) {
      $users[$user['ID']] = $user;
    }
    return $users;
  } 
  return false;
}

// Update profile photo
function updateProfile() {
  if (isset($_FILES['profile']) && $_FILES['profile']['name'] !== '') {
    $profile = uploadProfile('../uploads/profile');
    if ($profile != false) {
      return $profile;
    }
  }
  return false;
}

// Update Curriculum Vitae
function updateCv() {
  if (isset($_FILES['cv']) && $_FILES['cv']['name'] !== '') {
    if ($cv = uploadCv('../uploads/cv')) {
      return $cv;
    }
  }
  return false;
}

// Update User
function updateUser($conn, $data) {
  $stmt = mysqli_prepare($conn, "UPDATE users SET first_name=?, last_name=?, email=?, cv=?, profession=?, profile=? WHERE ID='" . $data['ID'] ."'");
  mysqli_stmt_bind_param($stmt, 'ssssss', $data['first_name'], $data['last_name'], $data['email'], $data['cv'], $data['profession'], $data['profile']);

  if(mysqli_stmt_execute($stmt)) {
    return true;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

?>