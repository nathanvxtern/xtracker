<div class="modal fade" id="editcustomerModal" tabindex="-1" role="dialog" aria-labelledby="editcustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editcustomerModalLabel">Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="edit_customer_form" :action="'customers/'+ctofilter" method="POST" name="edit_customer_form">
              {{ method_field('PUT') }}
                  @csrf
                  <div class="row form-group">
                      <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                          <label for="name">Customer Name</label>
                          <input v-model="editcustomername" type="text" class="form-control" id="create-link-name" name="name">
                      </div>
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" form="edit_customer_form"
                          data-form-id="edit_customer_form"
                          data-modal-id="edit-customer-modal"
                          @click="editcustomer( $event, ctofilter );"
                          data-dismiss="modal">Update</button>
      </div>
    </div>
  </div>
</div>