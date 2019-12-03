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
        <form id="create_tasks_form" :action="'customers/'+ctofilter+'/projects/'+ptofilter+'/tasks'" method="POST" name="create_tasks_form">
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
                <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                    <label for="reqcompdate">Requested Date:</label>
                    <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="create-link-reqcompdate" name="reqcompdate">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                    <label for="billingrate">Hourly Rate:</label>
                    <input type="text" class="form-control" id="create-link-billingrate" name="billingrate" placeholder="100">
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                    <label for="newtasktype">Type</label>
                    <select v-model="newtasktype" name="newtasktype" id="newtasktype" class="form-control" v-on:change="assignnewtasktype( newtasktype );">
                        <option selected>@{{ newtasktype }}</option>
                        <option v-for="type in currentobject.types" :key="type.projtyperowid">@{{ type.projtype }}</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                    <input type="hidden" class="form-control" id="projtyperowid" name="projtyperowid" placeholder="Type ID" v-bind:value="newtasktyperowid">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                    <label for="newtaskstatus">Status</label>
                    <select v-model="newtaskstatus" name="newtaskstatus" id="newtaskstatus" class="form-control" v-on:change="assignnewtaskstatus( newtaskstatus );">
                        <option selected>@{{ newtaskstatus }}</option>
                        <option v-for="status in currentobject.statuses" :key="status.projstatusrowid">@{{ status.projstatus }}</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                    <label for="custponumber">PO Number:</label>
                    <input type="text" class="form-control" id="create-link-custponumber" name="custponumber" placeholder="PO Number">
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                    <input type="hidden" class="form-control" id="projstatusrowid" name="projstatusrowid" placeholder="Status ID" v-bind:value="newtaskstatusrowid">
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