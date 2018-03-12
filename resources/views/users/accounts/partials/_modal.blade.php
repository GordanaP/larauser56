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
                    <p cklass="required-fields mb-18">
                        Fields marked with <sup><i class="fa fa-asterisk fa-form"></i></sup> are required.
                    </p>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        <input type="text" class="form-control name" id="name" name="name" placeholder="Enter your name" />

                        <span class="invalid-feedback name"></span>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">E-Mail Address <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        <input type="text" class="form-control email"  id="email" name="email" placeholder="example@domain.com" />

                        <span class="invalid-feedback email"></span>
                    </div>

                    <!-- Password-->
                    <div class="form-group mb-0">
                        <label for="create_password" class="mb-0">Password <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        <input type="password" class="form-control mt-8 password" id="password" name="password" placeholder="Give password to the user" />

                        <span class="invalid-feedback password"></span>
                    </div>

                    <div class="form-group mt-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="auto_password" id="auto_password" checked />
                            <label class="form-check-label" for="auto-password">
                                Auto generate password
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-account"></button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div>
</div>