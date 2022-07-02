<div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newModalLabel">New Record+</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
          <div class="mb-2">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="mb-2">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
          <div class="mb-2">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author">
          </div>
          <div class="modal-footer pb-0">
            <button type="submit" class="btn btn-primary">Add Record</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
