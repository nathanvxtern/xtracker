<!-- Rate that works 100 type that works 8 status that works 10 -->
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
                                        <label for="taskname">Task Name:</label>
                                        <input type="text" class="form-control" id="create-link-taskname" name="taskname" placeholder="Task Name">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="estimated">Estimated:</label>
                                        <input type="text" class="form-control" id="create-link-estimated" name="estimated" placeholder="Estimated">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="billingrate">Rate/hr:</label>
                                        <input type="text" class="form-control" id="create-link-billingrate" name="billingrate" placeholder="Rate/hr">
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="projtyperowid">Type:</label>
                                        <input type="text" class="form-control" id="projtyperowid" name="projtyperowid" placeholder="Type">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="projstatusrowid">Status:</label>
                                        <input type="text" class="form-control" id="create-link-projstatusrowid" name="projstatusrowid" placeholder="Status">
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                        <label for="custponumber">PO Number:</label>
                                        <input type="text" class="form-control" id="create-link-custponumber" name="custponumber" placeholder="PO Number">
                                    </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                      <input v-model="projrowidadd" type="hidden" class="form-control" id="create-link-projrowid" name="projrowid">
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
    </div>
  </div>
</div>