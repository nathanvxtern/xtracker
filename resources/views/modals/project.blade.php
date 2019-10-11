<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="projectModalLabel">Add Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="create_project_form" action="/projects" method="POST" name="create_project_form">
                              @csrf
                              <div class="row form-group">
                                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                      <label for="title">Project Title</label>
                                      <input type="text" class="form-control" id="create-link-title" name="title" placeholder="Title">
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                      <label for="custrowid">Customer</label>
                                      <input type="text" class="form-control" id="custrowid" name="custrowid" placeholder="Customer">
                                  </div>
                              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" type="submit" form="create_project_form"
                        data-form-id="create_project_form"
                        data-modal-id="create-project-modal">Submit</button>
      </div>
    </div>
  </div>
</div>