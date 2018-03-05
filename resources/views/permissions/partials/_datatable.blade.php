var datatable = permissionsTable.DataTable({
    "ajax": {
        "url": apiPermissionsIndexUrl,
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
        { data: 'name'},
        { data: 'created' },
        {
          render: function(data, type, row, meta) {
            return '<div class="flex justify-center align-center"><button class="btn btn-xs btn-edit" id="editPermission" value="' + row.permission + '"><i class="fa fa-pencil mr-12"></i></button><button class="btn btn-xs btn-link btn-primary btn-link-delete" id="deletePermission" value="' + row.permission + '"><i class="fa fa-trash"></i></button>'
          },
          searchable: false,
          sortable: false,
        },
        {
            data: 'permission',
            visible: false
        }
    ],
    "order": [[2, 'desc']],
    responsive: true,
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
    ]
});

setTableCounterColumn(datatable)
