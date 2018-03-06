var permission = $('#updatePermission').val()
var adminPermissionsUpdateUrl = adminPermissionsIndexUrl + '/' + permission

$.ajax({
    url: adminPermissionsUpdateUrl,
    type: "PUT",
    data: data,
    success: function(response) {

        datatable.ajax.reload();
        successResponse(editPermissionModal, response.message)
    },
    error: function(response) {

        errorResponse(response.responseJSON.errors, editPermissionModal)
    }
})