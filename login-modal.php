 <!-- Login Modal -->
  <div class="login-dialog">
    <a id="close-dialog"  onclick="closeDialog('login-dialog')">&times;</a>
    <div class="dialog-container">
      <div class="row">
        <div class="col-lg-6">
          <h3>Login</h3>
        </div>
      </div>
      <form id="loginForm" action="<?php echo ROOT;?>/account/" method="post" class="login-form" enctype="multipart/form-data">
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
            <button type="submit" name="action" value="login" class="btn btn-block btn-success">Login</button>
          </div>
        </div> 
      </form>
    </div>
  </div>
  <!-- End of Login Modal -->