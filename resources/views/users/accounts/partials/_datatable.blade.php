var datatable = table.DataTable({
    "ajax": {
        "url": apiAccountsIndexUrl,
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