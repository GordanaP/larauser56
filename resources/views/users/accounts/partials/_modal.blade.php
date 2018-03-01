<div class="modal" tabindex="-1" role="dialog" id="accountModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="accountForm">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa"></i>
                        <span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="required-fields mb-18">
                        Fields marked with <sup><i class="fa fa-asterisk fa-form"></i></sup> are required.
                    </p>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        <input type="text" class="form-control"  id="name" name="name" placeholder="Enter your name" />

                            <span class="invalid-feedback name"></span>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">E-Mail Address <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        <input type="text" class="form-control"  id="email" name="email" placeholder="example@domain.com" />

                        <span class="invalid-feedback email"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-account"></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>