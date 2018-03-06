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

    <!-- Edit Modal -->
    @include('permissions.partials._editModal')

    <!-- Create Modal -->
    @include('permissions.partials._createModal')

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var permissionsTable = $('#permissionsTable')
        var createPermissionForm = $('#createPermissionForm')
        var editPermissionForm = $('#editPermissionForm')
        var apiPermissionsIndexUrl = "{{ route('api.permissions.index') }}"
        var adminPermissionsIndexUrl = "{{ route('admin.permissions.index') }}"
        var createPermissionModal = $('#createPermissionModal')
        var editPermissionModal = $('#editPermissionModal')
        var permissionFields = ['resource', 'permission']

        // Set autofocus
        setModalAutofocus(editPermissionModal, 'resource')
        setModalAutofocus(createPermissionModal, 'resource')

        // Empty modal upon close
        createPermissionModal.emptyModal(permissionFields, createPermissionForm)
        editPermissionModal.emptyModal(permissionFields, editPermissionForm)

        // DataTable
        @include('permissions.partials._datatable')

        // Create permission
        @include('permissions.js._create')

        // JS store permission validation
        @include('permissions.js._validateStore')

        // Edit permission
        @include('permissions.js._edit')

        // JS update permission
        @include('permissions.js._validateUpdate')

        // Delete permission
        @include('permissions.js._delete')

    </script>

@endsection