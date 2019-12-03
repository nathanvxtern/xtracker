<div class="modal fade" id="deleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteTaskModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="delete_task_form" :action="'customers/'+ctofilter+'/projects/'+ptofilter+'/tasks/'+deletetasktaskrowid" method="POST" name="delete_task_form">
              {{ method_field('DELETE') }}
              @csrf
              <div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletetasktask">Task:</label>
                      <div class="text-left" id="deletetasktask" name="deletetasktask">
                          @{{ deletetasktask }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletetaskproject">Project:</label>
                      <div class="text-left" id="deletetaskproject" name="deletetaskproject">
                          @{{ deletetaskproject }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletetaskcustomer">Customer:</label>
                      <div class="text-left" id="deletetaskcustomer" name="deletetaskcustomer">
                          @{{ deletetaskcustomer }}
                      </div>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="button" form="delete_task_form"
                          data-form-id="delete_task_form"
                          data-modal-id="delete-task-modal"
                          @click="deletetask( $event, ctofilter, ptofilter, deletetasktaskrowid );"
                          data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>