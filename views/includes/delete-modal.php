<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to delete?</div>
        <div class="modal-footer">
          <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
            <input type="hidden" name="class_name" id="delete_class_name">
            <input type="hidden" name="id" id="recordId">
            <button class="btn btn-danger" type="submit" name="deleteBtn">Yes</button>
          </form>
          <a class="btn btn-success" href="#" data-dismiss="modal">No</a>
        </div>
      </div>
    </div>
</div>