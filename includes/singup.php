<?php
// Signup


// Output messages
$message = (object) array(
  'success' => '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success</strong> You have succesfully signed up!!!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>',
  'error' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error</strong signing up failed ,try again!!!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>',
  'form_error' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Error</strong> form has error!!!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>'
  );

// Check if form has error
function formHasError() {
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_FILES['cv']) && isset($_POST['profession']) && isset($_POST['username']) && isset($_POST['password'])) {
      $result;
      foreach ($_POST as $entity) {
        if (trim($entity) !== '') {
          $result = false;
        } else {
          $result = true;
        }
        return $result;
      }
    } else {
      return true;
    } 
}

// Handle signing up
if (isset($_POST['action']) && $_POST['action'] === "signup") {
  if (formHasError()) {
    echo $message->form_error;
  } else {
    $form = $_POST;
    $cvName = uploadCV('uploads/cv');

    if ($cvName !== false) {
      $form['cv'] = $cvName;
      $form['username'] = password_hash($form['username'], PASSWORD_DEFAULT);
      $form['password'] = password_hash($form['password'], PASSWORD_DEFAULT);

      $result = signupUser($conn ,$form);
      if ($result === true) {
        echo $message->success;
      } else {
        echo $message->error;
      } 
    }
  }
}


?>