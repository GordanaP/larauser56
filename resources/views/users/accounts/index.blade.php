@extends('layouts.admin')

@section('title', '| Admin | Accounts')

@section('links')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
@endsection


@section('content')

    <div class="pb-2 mb-3">
        <h1 class="h2">Accounts</h1>
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

    <div class="modal" tabindex="-1" role="dialog" id="accountModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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

                            <span class="invalid-feedback"></span>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">E-Mail Address <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        <input type="text" class="form-control"  id="email" name="email" placeholder="example@domain.com" />

                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-account">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

    <script>

        var table = $('#accountsTable')
        var apiAccountsIndexUrl = "{{ route('api.accounts.index') }}"
        var accountModal = $('#accountModal')

        @include('users.accounts.partials._datatable')

        // Edit account
        $(document).on('click', '#editAccount', function() {

            accountModal.modal('show')

            var user = $(this).val()
            var apiAccountsShowUrl = apiAccountsIndexUrl + '/' + user

            $('.modal-title i').addClass('fa-lock')
            $('.modal-title span').text('Edit account')
            $('.btn-account').attr('id','updateAccount').val(user) // asign user id(slug) to btn value

            $.ajax({
                url: apiAccountsShowUrl,
                type: "GET",
                success: function(response)
                {
                    var user = response.data

                    $('#name').val(user.name)
                    $('#email').val(user.email)
                }
            })
        });

    </script>
@endsection