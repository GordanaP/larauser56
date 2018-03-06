$(document).on('click', '#deletePermission', function(){

    var permission = $(this).val()
    var adminPermissionsDeleteUrl = adminPermissionsIndexUrl + '/' + permission

    swal({
        title: 'Are you sure?',
        text: 'You will not be able to recover the permission',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    })
    .then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url : adminPermissionsDeleteUrl,
                type : "DELETE",
                success : function(response) {

                    datatable.ajax.reload()
                    userNotification(response.message)
                },
            })
        }
    })
});