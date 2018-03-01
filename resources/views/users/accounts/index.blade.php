@extends('layouts.admin')

@section('title', '| Admin | Accounts')

@section('links')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
@endsection


@section('content')

    <div class="pb-2 mb-3 col-md-12">
        <h1 class="h2 flex align-center justify-between">
            <span>Accounts</span>
            <button class="btn btn-warning" id="createAccount">New account</button>
        </h1>
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

    <script>

        var table = $('#accountsTable')

        /**
         * Account
         */
        var apiAccountsIndexUrl = "{{ route('api.accounts.index') }}"
        var adminAccountsIndexUrl = "{{ route('admin.accounts.index') }}"
        var accountModal = $('#accountModal')
        var accountForm = $('#accountForm')
        var accountFields = ['name', 'email']

        setModalAutofocus(accountModal, 'name')
        emptyModalOnClose(accountFields, accountForm)

        // DataTable
        @include('users.accounts.partials._datatable')

        // Create account
        $(document).on('click', '#createAccount', function(){

            accountModal.modal('show')

            $('.modal-title i').addClass('fa-user')
            $('.modal-title span').text('New account')
            $('.btn-account').attr('id','storeAccount').text('Save')

        });

        // Edit account
        $(document).on('click', '#editAccount', function() {

            accountModal.modal('show')

            var user = $(this).val()
            var apiAccountsShowUrl = apiAccountsIndexUrl + '/' + user

            $('.modal-title i').addClass('fa-lock')
            $('.modal-title span').text('Edit account')
            $('.btn-account').attr('id','updateAccount').text('Save changes').val(user) // asign user id(slug) to btn value

            $.ajax({
                url: apiAccountsShowUrl,
                type: "GET",
                success: function(response) {

                    var user = response.data

                    $('#name').val(user.name)
                    $('#email').val(user.email)
                }
            })
        });


        //Update account
        $(document).on('click', '#updateAccount', function() {

            var user = $(this).val()
            var adminAccountsUpdateUrl = adminAccountsIndexUrl + '/' + user

            var data = {
                name : $("#name").val(),
                email : $("#email").val(),
            }

            $.ajax({
                url : adminAccountsUpdateUrl,
                type : "PUT",
                data: data,
                success : function(response) {

                    successResponse(datatable, accountModal, response.message)
                },
                error: function(response) {

                    errorResponse(response.responseJSON.errors, accountModal)
                }
            })
        });


    </script>
@endsection