$(document).on('click', '#editMyAccount', function(){

    accountModal.modal('show')

    var user = $(this).val()
    var editAccountUrl = '/admin/accounts/' + user + '/edit'

    $('#updateMyAccount').val(user)

    $.ajax({
        url: editAccountUrl,
        type: "GET",
        success: function(response) {

            var user = response.data

            $('#myName').val(user.name)
            $('#myEmail').val(user.email)
        }
    })
})
