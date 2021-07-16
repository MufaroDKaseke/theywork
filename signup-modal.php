<!-- Signup Modal -->
<!-- Signup Modal -->
<div class="signup-dialog">
  <a id="close-dialog" onclick="closeDialog('signup-dialog')">&times;</a>
  <div class="dialog-container">
    <div class="row">
      <div class="col-lg-6">
        <h3>Sign Up</h3>
      </div>
    </div>
    <form id="signupForm" action="<?php echo ROOT;?>/index.php" method="post" class="signup-form" enctype="multipart/form-data">
      <div class="tab-content" id="signupTabContent">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
          <div class="form-row">
            <div class="form-group col-lg-6">
              <label for="first_name">First Name</label>
              <input type="text" name="first_name" class="form-control" placeholder="First name" required>
            </div>
            <div class="form-group col-lg-6">
              <label for="last_name">Last Name</label>
              <input type="text" name="last_name" class="form-control" placeholder="Last name" required>
            </div>
            <div class="form-group col-12">
              <label for="email">Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="form-group col-12">
              <a href="#tab2" class="btn btn-block btn-success" data-toggle="tab"role="tab" aria-controls="tab2" aria-selected="true">Continue</a>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tab2" role="tabpanel">
          <div class="form-row">
            <div class="form-group col-12">
              <label for="cv">Curriculum Vitae</label>
              <input type="file" name="cv" class="form-control-file" placeholder="Curriculum Vitae">
            </div>
            <div class="form-group col-12">
              <label for="profession">Profession</label>
              <select class="form-control" name="profession" id="profession">
                <?php
                foreach (getProfessions() as $profession) {
                  echo '<option value="' . $profession . '">' . $profession . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group col-12">
              <a href="#tab3" class="btn btn-block btn-success" data-toggle="tab" role="tab" aria-controls="tab2" aria-selected="true">Continue</a>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tab3" role="tabpanel">
          <div class="form-row">
            <div class="form-group col-12">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Usernaem" required>
            </div>
            <div class="form-group col-12">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group col-12">
              <button type="submit" name="action" value="signup" class="btn btn-block btn-success">Submit</button>
            </div>
          </div>       
        </div>
      </div>
    </form>
  </div>
</div>
<!-- End Signup Modal -->