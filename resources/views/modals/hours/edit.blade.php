<div class="modal fade" id="editHoursModal" tabindex="-1" role="dialog" aria-labelledby="editHoursModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editHoursModalLabel">Edit Hours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="edit_hours_form" action="/hours/edit" method="POST" name="edit_hours_form">
              @csrf
              <div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <input v-model="edithourtaskrowid" type="hidden" class="form-control" id="create-link-taskrowid" name="taskrowid">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <input v-model="edithourcustrowid" type="hidden" class="form-control" id="create-link-custrowid" name="custrowid">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <input v-model="edithourhoursid" type="hidden" class="form-control" id="create-link-hoursid" name="hoursid">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="user_id" type="hidden">Employee</label>
                      <select class="form-control" id="user_id" name="user_id">
                        <option selected>@{{ currentobject.currentuser }}</option>
                        <option v-for="user in currentobject.users" :key="user.user_id">@{{ user.name }}</option>
                      </select>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="numhours">Number of Hours</label>
                      <input v-model="edithournumhours" type="text" class="form-control" id="numhours" name="numhours">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="dateentered">Date Entered</label>
                      <input v-model="edithourdateentered" class="form-control" type="date" value="{{date('Y-m-d')}}" id="dateentered" name="dateentered">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="notes">Notes</label>
                      <input v-model="edithournotes" type="text" class="form-control" id="notes" name="notes">
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="invoiceno">Invoice Number</label>
                      <input v-model="edithourinvoiceno" type="text" class="form-control" id="invoiceno" name="invoiceno">
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit" form="edit_hours_form"
                          data-form-id="edit_hours_form"
                          data-modal-id="edit-hours-modal">Submit</button>
      </div>
    </div>
  </div>
</div>