var user = $('#updateMyAccount').val()
var adminAccountsUpdateUrl = adminAccountsUrl + '/' + user

var data = {
    name : $("#myName").val(),
    email : $("#myEmail").val(),
    password: $("#myPassword").val(),
    password_confirmation: $("#myPasswordConfirm").val(),
}

$.ajax({
    url : adminAccountsUpdateUrl,
    type : "PUT",
    data: data,
    success : function(response) {
        $('#myAccount').load(location.href + ' #myAccount')
        successResponse(accountModal, response.message)
    },
    error: function(response) {
        errorResponse(response.responseJSON.errors, accountModal)
    }
})