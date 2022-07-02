<style>
  .modal-body {
    flex-direction: column;
  }
</style>
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header text-light">
        <h5 class="modal-title" id="signupModalLabel">SignUp</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="partials/_handleSignup.php" method="post">
        <div class="modal-body bg-light d-flex align-items-center">
          <div class="col-sm-10">
            <label for="signupEmail" class="col-form-label">Email address</label>
            <input type="email" class="form-control" id="signupEmail" name="signupEmail" required>
          </div>
          <div class="col-sm-10">
            <label for="signupPassword" class="col-form-label">Password</label>
            <input type="password" minlength="4" class="form-control" id="signupPassword" name="signupPassword" required>
          </div>
          <div class="col-sm-10">
            <label for="signupCpassword" class="col-form-label">Confirm Password</label>
            <input type="password" minlength="4" class="form-control" id="signupCpassword" name="signupCpassword" required>
          </div>
          <div class="d-grid col-4 mx-auto mt-4">
            <button type="submit" class="btn btn-dark">SignUp</button>
          </div>
        </div>
      </form>
      <div class="modal-footer text-light">
        <div class="col-sm-10">
          <label class="col-form-label">Already have a account?</label>
          <button class="btn link-primary float-end" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        </div>
      </div>
    </div>
  </div>
</div>