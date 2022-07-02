<style>
  .modal-body { flex-direction: column; }
</style>
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-light">
        <h5 class="modal-title" id="signupModalLabel">SignUp</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="partials/_handleSignup.php" method="post">
        <div class="modal-body d-flex align-items-center">
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
        </div>
        <div class="modal-footer bg-success text-light">
          <div class="d-grid col-4 mx-auto">
            <button type="submit" class="btn btn-primary">SignUp</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
