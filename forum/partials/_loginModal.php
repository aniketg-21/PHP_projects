<style>
  .modal-body { flex-direction: column; }
</style>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-light">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="partials/_handleLogin.php" method="post">
        <div class="modal-body d-flex align-items-center">
          <div class="col-sm-10">
            <label for="loginEmail" class="col-form-label">Username</label>
            <input type="email" class="form-control" id="loginEmail" name="loginEmail">
          </div>
          <div class="col-sm-10">
            <label for="loginPass" class="col-form-label">Password</label>
            <input type="password" minlength="4" class="form-control" id="loginPass" name="loginPass">
          </div>
        </div>
        <div class="modal-footer bg-success text-light">
          <div class="d-grid col-4 mx-auto">
            <button type="submit" class="btn btn-primary">login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
