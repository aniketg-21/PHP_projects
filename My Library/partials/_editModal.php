<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
          <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="mb-2">
            <label for="titleEdit" class="form-label">Title</label>
            <input type="text" class="form-control" id="titleEdit" name="titleEdit">
          </div>
          <div class="mb-2">
            <label for="descriptionEdit" class="form-label">Description</label>
            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
          </div>
          <div class="mb-2">
            <label for="authorEdit" class="form-label">Author</label>
            <input type="text" class="form-control" id="authorEdit" name="authorEdit">
          </div>
          <div class="modal-footer pb-0">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
