@extends('layouts.admin')

@section('title', '| Admin | Permissions')

@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')
    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>Permissions</span>
            <button class="btn btn-warning" id="createPermission">
                <span data-feather="plus"></span> New permission
            </button>
        </h1>

        <hr>

        <div class="table-responsive admin-table-wrapper">
            <table class="table hover order-column admin-table" id="permissionsTable" cellspacing="0" width="100%">
                <thead>
                    <th>#</th>
                    <th><i data-feather="thumbs-up" class="mr-6"></i> Permission</th>
                    <th><i class="fa fa-calendar mr-6"></i> Created</th>
                    <th class="text-center"><i class="fa fa-cog mr-6"></i></th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="permissionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="permissionForm">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa mr-6"></i>
                            <span></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="required-fields mb-18">
                            <sup><i class="fa fa-asterisk fa-form"></i></sup> Required field.
                        </p>

                        <!-- Resources -->
                        <div class="form-group mb-4">
                            <label for="resource">Resource <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>
                            <select class="form-control resource" name="resource" id="resource">
                                <option value="">Select a resource</option>
                                @foreach (Resources::all() as $resource)
                                    <option value="{{ $resource }}">
                                        {{ $resource }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="invalid-feedback resource"></span>
                        </div>

                        <!-- CRUD methods -->
                        <div class="form-group">
                            <label for="">Select a permission <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                            @foreach (Cruds::all() as $key => $value)
                                <div class="form-check">
                                    <input class="form-check-input permission" type="checkbox" name="permission[]" id="permission" value="{{ $key }}" multiple="multiple">
                                    <label class="form-check-label" for="{{ $key }}">{{ strtoupper($value) }}</label>
                                </div>
                            @endforeach

                            <span class="invalid-feedback permission"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-permission"></button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var permissionForm = $('#permissionForm')
        var permissionsTable = $('#permissionsTable')
        var apiPermissionsIndexUrl = "{{ route('api.permissions.index') }}"
        var adminPermissionsIndexUrl = "{{ route('admin.permissions.index') }}"
        var permissionModal = $('#permissionModal')
        var permissionFields = ['resource', 'permission']

        // Set autofocus
        setModalAutofocus(permissionModal, 'resource')

        // Empty modal on close
        permissionModal.emptyModal(permissionFields, permissionForm)

        // DataTable
        @include('permissions.partials._datatable')

        // Create permission
        @include('permissions.js._create')

        // JS form validation
        permissionForm.formValidation({
                framework: 'bootstrap4',
                excluded: ':disabled',
                icon: {
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                },
                fields: {
                    resource: {
                        validators: {
                            notEmpty: {
                                message: 'The resource is required.'
                            },
                        }
                    },
                    'permission[]': {
                        validators: {
                            notEmpty: {
                                message: 'The permission is required.'
                            },
                        }
                    },
                }
            })
            .on('success.form.fv', function(e) {

                // form button must be type="submit"!!!
                e.preventDefault();

                var permissions = $("input[name*='permission']:checked")

                var data = {
                    resource : $('#resource').val(),
                    permission: checkboxValues(permissions)
                }

                // Store permission
                if($(".btn-permission").attr('id') == 'storePermission') {

                    $.ajax({
                        url: adminPermissionsIndexUrl,
                        type: "POST",
                        data: data,
                        success: function(response) {

                            datatable.ajax.reload();
                            successResponse(permissionModal, response.message)

                        },
                        error: function(response) {

                            errorResponse(response.responseJSON.errors, permissionModal)
                        }
                    })
                }

                // Update permission
                if($(".btn-permission").attr('id') == 'updatePermission') {

                    //
                }
            });




    </script>

@endsection