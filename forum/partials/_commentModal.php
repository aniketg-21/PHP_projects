<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <div class="modal-body d-flex align-items-center bg-success text-light">
          <div class="col-sm-10">
            <label for="comment" class="col-form-label fs-4 col-md-11 fst-italic"><b>Your comment</b></label>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <textarea class="form-control" id="comment" name="comment"></textarea>
          </div>
        </div>
        <div class="my-2 d-flex justify-content-end mx-2">
          <button type="submit" class="btn btn-primary mx-5">Post Comment</button>
        </div>
      </form>
    </div>
  </div>
</div>
