<div class="modal fade" id="addHoursModal" tabindex="-1" role="dialog" aria-labelledby="addHoursModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHoursModalLabel">Add Hours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="create_hours_form" :action="'customers/'+ctofilter+'/projects/'+ptofilter+'/tasks/'+taskrowidadd+'/hours'" method="POST" name="create_hours_form">
              @csrf
              <div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="user_id" type="hidden">Employee</label>
                      <select class="form-control" id="user_id" name="user_id">
                        <option selected>@{{ currentuser.name }}</option>
                        <option v-for="user in currentobject.users" :key="user.user_id">@{{ user.name }}</option>
                      </select>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="numhours">Number of Hours</label>
                      <input type="text" class="form-control" id="numhours" name="numhours" placeholder="Numhours">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="dateentered">Date Entered</label>
                      <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="dateentered" name="dateentered">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="notes">Notes</label>
                      <input type="text" class="form-control" id="notes" name="notes" placeholder="notes">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="invoiceno">Invoice Number</label>
                      <input type="text" class="form-control" id="invoiceno" name="invoiceno" placeholder="invoiceno">
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="button" 
                          form="create_hours_form"
                          data-form-id="create_hours_form"
                          data-modal-id="create-hours-modal"
                          @click="addhours( $event, ctofilter, ptofilter, taskrowidadd );"
                          data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>