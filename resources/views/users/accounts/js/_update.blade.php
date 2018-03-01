var user = $("#updateAccount").val()
var adminAccountsUpdateUrl = adminAccountsUrl + '/' + user

$.ajax({
    url : adminAccountsUpdateUrl,
    type : "PUT",
    data: data,
    success : function(response) {

        successResponse(datatable, accountModal, response.message)
    },
    error: function(response) {

        errorResponse(response.responseJSON.errors, accountModal)
    }
})