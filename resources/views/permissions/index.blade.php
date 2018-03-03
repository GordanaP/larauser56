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
            <button class="btn btn-warning" id="createRole">
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

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var permissionForm = $('#permissionForm')
        var table = $('#permissionsTable')
        var apiPermissionsIndexUrl = "{{ route('api.permissions.index') }}"

        @include('permissions.partials._datatable')

        permissionForm.formValidation({
            framework: 'bootstrap4',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                resource: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required.'
                        },
                    }
                },
                'permission[]': {
                    validators: {
                        notEmpty: {
                            message: 'The name is required.'
                        },
                    }
                },
            }
        })

    </script>

@endsection