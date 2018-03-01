$.ajax({
    url: adminAccountsUrl,
    type: "POST",
    data: data,
    success: function(response) {

        successResponse(datatable, accountModal, response.message)
    },
    error: function(response) {

        errorResponse(response.responseJSON.errors, accountModal)
    }
})