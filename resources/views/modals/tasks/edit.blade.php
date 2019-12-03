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
          <form id="edit_task_form" :action="'customers/'+ctofilter+'/projects/'+ptofilter+'/tasks/'+taskrowidtaskedit" method="POST" name="edit_task_form">
              {{ method_field('PUT') }}
                  @csrf
                  <div class="row form-group">
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <label for="title">Task Title</label>
                          <input v-model="edittasktitle" type="text" class="form-control" id="create-link-title" name="title">
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <label for="esthours">Estimate Hours</label>
                          <input v-model="edittaskesthours" type="text" class="form-control" id="create-link-esthours" name="esthours">
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <label for="reqcompdate">Date Entered</label>
                          <input v-model="edittaskreqcompdate" class="form-control" type="date" value="{{date('Y-m-d')}}" id="reqcompdate" name="reqcompdate">
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <label for="billingrate">Billing Rate</label>
                          <input v-model="edittaskbillingrate" type="text" class="form-control" id="create-link-billingrate" name="billingrate">
                      </div>
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" form="edit_task_form"
                          data-form-id="edit_task_form"
                          data-modal-id="edit-task-modal"
                          @click="edittask( $event, ctofilter, ptofilter, taskrowidtaskedit );"
                          data-dismiss="modal">Update</button>
      </div>
    </div>
  </div>
</div>