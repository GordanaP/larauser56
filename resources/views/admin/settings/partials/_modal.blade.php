<div class="modal admin-modal" tabindex="-1" role="dialog" id="accountModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="accountForm">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-user"></i> Edit account
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

                        <input type="text" class="form-control name admin-modal-input" id="myName" name="name" placeholder="Enter your name" />

                        <span class="invalid-feedback name"></span>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">E-Mail Address <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        <input type="text" class="form-control email admin-modal-input"  id="myEmail" name="email" placeholder="example@domain.com" />

                        <span class="invalid-feedback email"></span>
                    </div>

                    <!-- Password-->
                    <div class="form-group">
                        <label for="create_password">Password</label>

                        <input type="password" class="form-control password admin-modal-input" id="myPassword" name="password" placeholder="Choose your password" />

                        <span class="password invalid-feedback"></span>
                    </div>

                    <!-- Confirm password -->
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>

                        <input type="password" class="form-control"  id="myPasswordConfirm" name="password_confirmation" placeholder="Retype password">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-account admin-modal-btn" id="updateMyAccount">Save changes</button>
                    <button type="button" class="btn btn-secondary admin-modal-btn-close" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div>
</div>