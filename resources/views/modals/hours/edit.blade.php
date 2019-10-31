<div class="modal fade" id="editHoursModal" tabindex="-1" role="dialog" aria-labelledby="editHoursModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editHoursModalLabel">Edit Hours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><div class="modal-body">
          <form id="edit_hours_form" action="/hours/edit" method="POST" name="edit_hours_form">
              {{ method_field('PATCH') }}
                  @csrf
                  <div>
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <input v-model="taskrowidhoursedit" type="text" class="form-control" id="create-link-taskrowid" name="taskrowid">
                      </div>
                  </div>
                    <table class="table">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                        <tr v-for="hour in hourshoursedit" v-bind:key="hour.hourid">
                            <td>
                                <input v-model="hour.numhours" type="text" class="form-control" id="create-link-numhours" name="numhours">
                            </td>
                        </tr>
                    </table>
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