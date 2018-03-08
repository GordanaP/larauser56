$.ajax({
    url: adminPermissionsIndexUrl,
    type: "POST",
    data: storeData,
    success: function(response) {
        console.log(response)
        datatable.ajax.reload();
        successResponse(createPermissionModal, response.message)
    },
    error: function(response) {
        errorResponse(response.responseJSON.errors, createPermissionModal)
    }
})