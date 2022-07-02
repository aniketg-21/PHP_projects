<div class="modal fade" id="quesModal" tabindex="-1" aria-labelledby="quesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-light">
        <h5 class="modal-title" id="quesModalLabel">Ask your question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <div class="modal-body d-flex align-items-center">
          <div class="col-sm-10">
            <label for="title" class="col-form-label fs-4"><b>Title</b></label>
            <input type="text" class="form-control" id="title" name="title">
            <small> Keep your title short </small>
          </div>
          <div class="col-sm-10">
            <label for="desc" class="col-form-label fs-4"><b>Your Concern</b></label>
            <textarea class="form-control" id="desc" name="desc"></textarea>
          </div>
          <div class="text-center my-2">
            <button type="submit" class="btn btn-success" style="width: 150px;">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
