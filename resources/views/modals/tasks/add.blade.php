<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="create_tasks_form" action="/tasks" method="POST" name="create_tasks_form">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="billingrate">Billing Rate</label>
                                        <input type="text" class="form-control" id="create-link-billingrate" name="billingrate" placeholder="Billingrate">
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="projstatusrowid">Project Status Code</label>
                                        <input type="text" class="form-control" id="create-link-projstatusrowid" name="projstatusrowid" placeholder="Projstatusrowid">
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="projtyperowid">Project Type Code</label>
                                        <input type="text" class="form-control" id="projtyperowid" name="projtyperowid" placeholder="Projtyperowid">
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="projrowid">Project Row Id</label>
                                        <input type="text" class="form-control" id="create-link-projrowid" name="projrowid" placeholder="Projectrowid">
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="title">Task Title</label>
                                        <input type="text" class="form-control" id="create-link-title" name="title" placeholder="Title">
                                    </div>
                                </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit" form="create_tasks_form"
                          data-form-id="create_tasks_form"
                          data-modal-id="create-tasks-modal">Submit</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" type="submit" form="create_task_form"
                        data-form-id="create_task_form"
                        data-modal-id="create-task-modal">Submit</button>
      </div>
    </div>
  </div>
</div>