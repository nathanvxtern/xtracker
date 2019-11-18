<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerModalLabel">Add Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="create_customer_form" action="/customers" method="POST" name="create_customer_form">
                              @csrf
                              <div class="row form-group">
                                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                      <label for="title">Customer</label>
                                      <input type="text" class="form-control" id="create-link-title" name="customer" placeholder="Customer">
                                  </div>
                              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" type="submit" form="create_customer_form"
                        data-form-id="create_customer_form"
                        data-modal-id="create-customer-modal">Submit</button>
      </div>
    </div>
  </div>
</div>