@extends('layouts.admin')

@section('title', '| Admin | Accounts')

@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('content')

    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>Accounts</span>
            <button class="btn btn-warning" id="createAccount"><span data-feather="plus"></span> New account</button>
        </h1>
        <hr>
    </div>

    <div class="table-responsive admin-table-wrapper">
        <table class="table hover order-column admin-table" id="accountsTable" cellspacing="0" width="100%">
            <thead>
                <th>#</th>
                <th><i class="fa fa-user mr-6"></i> Name</th>
                <th><i class="fa fa-envelope mr-6"></i> Email</th>
                <th><i class="fa fa-calendar mr-6"></i> Joined</th>
                <th class="text-center"><i class="fa fa-cog mr-6"></i></th>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    @include('users.accounts.partials._modal')

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap4.min.js') }}"></script>

    <script>

        var table = $('#accountsTable')

        /**
         * Account
         */
        var apiAccountsIndexUrl = "{{ route('api.accounts.index') }}"
        var adminAccountsUrl = "{{ route('admin.accounts.index') }}"
        var accountModal = $('#accountModal')
        var accountForm = $('#accountForm')
        var accountFields = ['name', 'email']

        setModalAutofocus(accountModal, 'name')
        emptyModalOnClose(accountFields, accountForm)

        // DataTable
        @include('users.accounts.partials._datatable')

        // Create account
        @include('users.accounts.js._create')

        // Edit account
        @include('users.accounts.js._edit')

        // Validate account
        @include('users.accounts.js._validate')

        // Delete account
        @include('users.accounts.js._delete')

    </script>
@endsection