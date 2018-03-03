$(document).on('click', '#deleteRole', function() {

    var role = $(this).val()
    var adminRolesDeleteUrl = adminRolesIndexUrl + '/' + role

    swal({
        title: 'Are you sure?',
        text: 'You will not be able to recover the role',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    })
    .then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url : adminRolesDeleteUrl,
                type : "DELETE",
                success : function(response) {

                    $('#displayRoles').load(location.href + " #displayRoles")
                    userNotification(response.message)
                },
            })
        }
    })
})