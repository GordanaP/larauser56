$(document).on('click', '#editMyAccount', function(){

    accountModal.modal('show')

    var user = $(this).val()
    var editAccountUrl = '/admin/accounts/' + user

    $('#updateMyAccount').val(user)

    $.ajax({
        url: editAccountUrl,
        type: "GET",
        success: function(response) {

            $('#myName').val(response.user.name)
            $('#myEmail').val(response.user.email)
        }
    })
})
