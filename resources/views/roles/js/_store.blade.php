$.ajax({
    url: adminRolesIndexUrl,
    type: "POST",
    data: data,
    success: function(response) {

        $('#displayRoles').load(location.href + " #displayRoles")
        roleModal.modal('hide')
        userNotification(response.message)
    },
    error: function(response) {

        errorResponse(response.responseJSON.errors, roleModal)
    }
})