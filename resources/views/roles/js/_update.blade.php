var role = $('#updateRole').val()
var adminRolesUpdateUrl = adminRolesIndexUrl + '/' + role

$.ajax({
    url: adminRolesUpdateUrl,
    type: "PUT",
    data: data,
    success: function(response) {

        $('#displayRoles').load(location.href + " #displayRoles")
        successResponse(roleModal, response.message)
    },
    error: function(response) {

        errorResponse(response.responseJSON.errors, roleModal)

    }
})