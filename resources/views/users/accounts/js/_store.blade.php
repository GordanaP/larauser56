$.ajax({
    url: adminAccountsUrl,
    type: "POST",
    data: data,
    success: function(response) {

        datatable.ajax.reload()
        successResponse(accountModal, response.message)
    },
    error: function(response) {

        errorResponse(response.responseJSON.errors, accountModal)
    }
})