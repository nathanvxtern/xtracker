<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <a href="/confirm/delete/task" class="btn btn-primary">
              Delete
          </a>
          <form id="edit_task_form" action="/task/edit" method="POST" name="edit_task_form">
              {{ method_field('PATCH') }}
                  @csrf
                  <div>
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <input v-model="taskrowidtaskedit" type="text" class="form-control" id="create-link-taskrowid" name="taskrowid">
                      </div>
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>