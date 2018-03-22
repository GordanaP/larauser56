@extends('layouts.admin')

@section('title', '| Admin | Accounts')

@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')

    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>Accounts</span>
            <button class="btn btn-warning" id="createAccount">New account</button>
        </h1>
        <hr>
    </div>

    <!-- Accounts Table -->
    <div class="table-responsive admin-table-wrapper">
        <table class="table hover order-column admin-table" id="accountsTable" cellspacing="0" width="100%">
            <thead>
                <th>#</th>
                <th><i class="fa fa-user mr-6"></i> Name</th>
                <th><i class="fa fa-envelope mr-6"></i> Email</th>
                <th><i class="fa fa-briefcase mr-6"></i> Role</th>
                <th><i class="fa fa-circle"></i> Status</th>
                <th><i class="fa fa-calendar mr-6"></i> Joined</th>
                <th class="text-center"><i class="fa fa-cog mr-6"></i></th>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Account Modals -->
    @include('users.accounts.partials._createModal')
    @include('users.accounts.partials._editModal')

    <div class="modal" tabindex="-1" role="dialog" id="revokeRolesModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="revokeRolesForm">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-user"></i>
                            <span></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="required-fields mb-18">
                            <sup><i class="fa fa-asterisk fa-form"></i></sup> Required field
                        </p>

                        <!-- Roles -->
                        <div class="form-group">

                            <label for="role_id">Revoke role(s) <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                            <div id="role">

                                <!-- Render checkbox values for the specific user by using an ajax call -->

                            </div>

                            <span class="invalid-feedback role_id"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="revokeRoles">Revoke</button>
                    </div>
                </form>

            </div><!-- /. modal-content -->
        </div>
    </div>

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        // Table
        var table = $('#accountsTable')

        // Url
        var apiAccountsIndexUrl = "{{ route('api.accounts.index') }}"
        var adminAccountsUrl = "{{ route('admin.accounts.index') }}"

        // Form fields
        var accountFields = ['role_id', 'name', 'email', 'password']

        // Create
        var createAccountModal = $('#createAccountModal')
        var createAccountForm = $('#createAccountForm')
        var auto_password = $('#auto_password')
        var password = $("#password")
        password.hide()

        // Edit
        var editAccountModal = $('#editAccountModal')
        var editAccountForm = $('#editAccountForm')
        var _unchanged_password = $('#_unchanged_password')
        var _password = $("#_password")
        _password.hide()

        // Modals
        createAccountModal.setAutofocus('role_id')
        createAccountModal.emptyModal(accountFields, createAccountForm, auto_password, password)

        editAccountModal.setAutofocus('_role_id')
        editAccountModal.emptyModal(accountFields, editAccountForm, _unchanged_password, _password)

        var revokeRolesModal = $('#revokeRolesModal')
        var revokeRolesFomr = $('#revokeRolesForm')

        // DataTable
        @include('users.accounts.partials._datatable')

        // Edit user roles
        $(document).on('click', '#editRoles', function() {

            var user = $(this).attr('data-user');
            var UserRolesUrl = '/users/accounts/' + user + '/edit'

            revokeRolesModal.modal("show")

            $(".modal-title span").text(user)
            $("#revokeRoles").val(user) // attach user

            $.ajax({
                url: UserRolesUrl,
                type: "GET",
                success: function(response) {
                    $('#role').html(response.html);
                }
            })
        })

        // Revoke user role(s)
        $(document).on('click', '#revokeRoles', function(){

            var user = $(this).val()
            var revokeRolesUrl = '/admin/roles-revoke/' + user

            var roleIds = checkedValues('role_id')

            var data = {
                role_id: roleIds
            }

            $.ajax({
                url: revokeRolesUrl,
                type: "DELETE",
                data: data,
                success: function(response)
                {
                    datatable.ajax.reload()
                    successResponse(revokeRolesModal, response.message)
                },
            })
        })


        // Create account
        @include('users.accounts.js._create')

        // Store account
        @include('users.accounts.js._store')

        // Edit account
        @include('users.accounts.js._edit')

        // Update account
        @include('users.accounts.js._update')

        // Delete account
        @include('users.accounts.js._delete')

    </script>
@endsection