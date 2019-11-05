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
                          <input v-model="taskrowidhoursedit" type="hidden" class="form-control" id="create-link-taskrowid" name="taskrowid">
                      </div>
                  </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">numhours</th>
                                <th scope="col">user_id</th>
                                <th scope="col">dateentered</th>
                                <th scope="col">notes</th>
                                <th scope="col">invoiceno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="hour in hourshoursedit" v-bind:key="hour.hoursid">
                                <td>
                                    <input v-model="hour.numhours" type="text" class="form-control" id="create-link-numhours" name="numhours">
                                </td>
                                <td>
                                    <input v-model="hour.user_id" type="text" class="form-control" id="create-link-user_id" name="user_id">
                                </td>
                                <td>
                                    <input v-model="hour.dateentered" type="text" class="form-control" id="create-link-dateentered" name="dateentered">
                                </td>
                                <td>
                                    <input v-model="hour.notes" type="text" class="form-control" id="create-link-notes" name="notes">
                                </td>
                                <td>
                                    <input v-model="hour.invoiceno" type="text" class="form-control" id="create-link-invoiceno" name="invoiceno">
                                </td>
                                <td>
                                    <a :v-model="hour.hoursid" :href="'/confirm/delete/hour/'+hour.hoursid" class="btn btn-primary">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
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