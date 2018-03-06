var user = $("#updateAccount").val()
var adminAccountsUpdateUrl = adminAccountsUrl + '/' + user

$.ajax({
    url : adminAccountsUpdateUrl,
    type : "PUT",
    data: data,
    success : function(response) {
        datatable.ajax.reload();
        successResponse(accountModal, response.message)
    },
    error: function(response) {

        errorResponse(response.responseJSON.errors, accountModal)
    }
})