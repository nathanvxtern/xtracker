<div class="modal fade" id="deletecustomerModal" tabindex="-1" role="dialog" aria-labelledby="deletecustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletecustomerModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="delete_customer_form" :action="'customers/'+ctofilter" method="POST" name="delete_customer_form">
              {{ method_field('DELETE') }}
              @csrf
              <div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <label for="custrowid">Customer:</label>
                      <div class="text-left" id="custrowid" name="custrowid" value="ctofilter">
                          @{{ delete_customer_name }}
                      </div>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="button" form="delete_customer_form"
                          data-form-id="delete_customer_form"
                          data-modal-id="delete-customer-modal"
                          @click="deletecustomer( $event, ctofilter );"
                          data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>