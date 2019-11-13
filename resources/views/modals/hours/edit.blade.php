<div class="modal fade" id="editHoursModal" tabindex="-1" role="dialog" aria-labelledby="editHoursModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editHoursModalLabel">Edit Hours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><div class="modal-body">
          <form id="edit_hours_form" :action="'/hours/edit/' + hoursidtoedit + '/' + numhourstoedit + '/' + user_idtoedit + '/' + dateenteredtoedit + '/' + notestoedit + '/' + invoicenotoedit" method="POST" name="edit_hours_form">
              {{ method_field('PATCH') }}
                  @csrf
                  <div>
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <input v-model="taskrowidhoursedit" type="hidden" class="form-control" id="create-link-taskrowid" name="taskrowid">
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <input v-model="hourshoursedit" type="hidden" class="form-control" id="create-link-hours" name="hours">
                      </div>
                  </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">numhours</th>
                                <th scope="col">employee</th>
                                <th scope="col">dateentered</th>
                                <th scope="col">notes</th>
                                <th scope="col">invoiceno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(hour,index) in hourshoursedit" v-bind:key="hourshoursedit[index].hoursid">
                                <td>
                                    <input v-model="hourshoursedit[index].numhours" type="text" class="form-control" id="create-link-numhours" name="numhours" @change="updatenumhourstoedit( hour.hoursid, hour.numhours )">
                                </td>
                                <td>
                                    <select v-model="hourshoursedit[index].user_id" class="form-control" id="user_id" name="user_id" placeholder="user" @change="updateuser_idtoedit( hour.hoursid, hour.user_id )">
                                        <option selected>Employee</option>
                                        <option v-for="user in currentObject.users" :key="user.user_id">@{{ user.name }}</option>
                                    </select>
                                </td>
                                <td>
                                    <input v-model="hourshoursedit[index].dateentered" type="text" class="form-control" id="create-link-dateentered" name="dateentered" @change="updatedateenteredtoedit( hour.hoursid, hour.dateentered )">
                                </td>
                                <td>
                                    <input v-model="hourshoursedit[index].notes" type="text" class="form-control" id="create-link-notes" name="notes" @change="updatenotestoedit( hour.hoursid, hour.notes )">
                                </td>
                                <td>
                                    <input v-model="hourshoursedit[index].invoiceno" type="text" class="form-control" id="create-link-invoiceno" name="invoiceno" @change="updateinvoicenotoedit( hour.hoursid, hour.invoiceno )">
                                </td>
                                <td>
                                    <input v-model="hourshoursedit[index].hoursid" type="hidden" class="form-control" id="create-link-hoursid" name="hoursid">
                                </td>
                                <td>
                                    <a :v-model="hour.hoursid" :href="'/confirm/delete/hour/'+hour.hoursid" class="btn btn-primary">
                                        Delete
                                    </a>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary" form="edit_hours_form"
                                                    data-form-id="edit_hours_form"
                                                    data-modal-id="edit-hours-modal"
                                                    @click="populatetaskcomponent(selectedproject);
                                                            updatenumhourstoedit( hour.hoursid, hour.numhours );
                                                            updateuser_idtoedit( hour.hoursid, hour.user_id );
                                                            updatedateenteredtoedit( hour.hoursid, hour.dateentered );
                                                            updatenotestoedit( hour.hoursid, hour.notes );
                                                            updateinvoicenotoedit( hour.hoursid, hour.invoiceno );">Update</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>