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

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

    <script>

        var table = $('#accountsTable')
        var ApiAccountUrl = "{{ route('api.accounts') }}"

        var datatable = table.DataTable({
            "ajax": {
                "url": ApiAccountUrl,
                "type": "GET"
            },
            "deferRender": true, // Increase the speed of the table loading
            "columns": [
                {
                    render: function(data, type, row, meta) {
                        return ''
                    },
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'name',
                    render: function(data, type, row, meta) {
                        return '<a href="#" data-user="' + row.user + '"  id="editProfile">' + data +'</a>'
                    }
                },
                { data: 'email' },
                { data: 'joined' },
                {
                  render: function(data, type, row, meta) {
                    return '<div class="flex justify-center align-center"><button class="btn btn-xs btn-edit" id="editAccount" value="' + row.user + '"><i class="fa fa-pencil mr-12"></i></button><button class="btn btn-xs btn-link btn-primary btn-link-delete" id="deleteAccount" value="' + row.user + '"><i class="fa fa-trash"></i></button>'
                  },
                  searchable: false,
                  sortable: false,
                },
                {
                    data: 'user',
                    visible: false
                }
            ],
            "order": [[2, 'desc']],
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 2 }
            ]
        });

        setTableCounterColumn(datatable)

    </script>
@endsection