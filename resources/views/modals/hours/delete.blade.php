<div class="modal fade" id="deleteHoursModal" tabindex="-1" role="dialog" aria-labelledby="deleteHoursModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteHoursModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="delete_hours_form" :action="'customers/'+ctofilter+'/projects/'+ptofilter+'/tasks/'+edithourtaskrowid+'/hours/'+deletehourshoursid" method="POST" name="delete_hours_form">
              {{ method_field('DELETE') }}
              @csrf
              <div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletehoursemployee">Employee:</label>
                      <div class="text-left" id="deletehoursemployee" name="deletehoursemployee">
                          @{{ deletehoursemployee }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletehoursdateentered">Date:</label>
                      <div class="text-left" id="deletehoursdateentered" name="deletehoursdateentered">
                          @{{ deletehoursdateentered }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletehoursnumhours">Number of Hours:</label>
                      <div class="text-left" id="deletehoursnumhours" name="deletehoursnumhours">
                          @{{ deletehoursnumhours }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletehourstask">Task:</label>
                      <div class="text-left" id="deletehourstask" name="deletehourstask">
                          @{{ deletehourstask }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletehoursproject">Project:</label>
                      <div class="text-left" id="deletehoursproject" name="deletehoursproject">
                          @{{ deletehoursproject }}
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="deletehourscustomer">Customer:</label>
                      <div class="text-left" id="deletehourscustomer" name="deletehourscustomer">
                          @{{ deletehourscustomer }}
                      </div>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="button" form="delete_hours_form"
                          data-form-id="delete_hours_form"
                          data-modal-id="delete-hours-modal"
                          @click="deletehours( $event, ctofilter, ptofilter, edithourtaskrowid, deletehourshoursid );"
                          data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>