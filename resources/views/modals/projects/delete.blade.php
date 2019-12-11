<div class="modal fade" id="deleteprojectModal" tabindex="-1" role="dialog" aria-labelledby="deleteprojectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteprojectModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="delete_project_form" :action="'customers/'+ctofilter+'/projects/'+ptofilter" method="POST" name="delete_project_form">
              {{ method_field('DELETE') }}
              @csrf
              <div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="projrowid">Project:</label>
                      <div class="text-left" id="projrowid" name="projrowid" :value="ptofilter">
                          @{{ delete_project_title }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="custrowid">Customer:</label>
                      <div class="text-left" id="custrowid" name="custrowid" :value="ctofilter">
                          @{{ delete_project_customer }}
                      </div>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="button" form="delete_project_form"
                          data-form-id="delete_project_form"
                          data-modal-id="delete-project-modal"
                          @click="deleteproject( $event, ctofilter, ptofilter );"
                          data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>