<div class="modal fade" id="editprojectModal" tabindex="-1" role="dialog" aria-labelledby="editprojectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editprojectModalLabel">Edit Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="edit_project_form" :action="'customers/'+ctofilter+'/projects/'+ptofilter" method="POST" name="edit_project_form">
              {{ method_field('PUT') }}
              @csrf
              <div class="row form-group">
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="title">Project Title</label>
                      <input v-bind:value="editprojecttitle" v-bind:label="editprojecttitle" type="text" class="form-control" id="create-link-title" name="title">
                  </div>
              </div>
              <div class="row form-group">
                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                      <label for="custrowid">Customer Name: @{{ newprojectcustomer }}</label>
                      <select :v-model="editprojectcustrowid" name="custrowid" id="custrowid" class="form-control" v-on:change="populateeditprojectmodal( editprojectcustrowid, ptofilter );">
                          <option v-for="customer in currentobject.customers" :key="customer.custrowid" :label="customer.name">@{{ customer.custrowid }}</option>
                      </select>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" form="edit_project_form"
                          data-form-id="edit_project_form"
                          data-modal-id="edit-project-modal"
                          @click="editproject( $event, ctofilter, ptofilter );"
                          data-dismiss="modal">Update</button>
      </div>
    </div>
  </div>
</div>