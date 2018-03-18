$(document).on('click', '#editAccount', function(){

    editAccountModal.modal('show')

    var user = $(this).val()
    var apiAccountsShowUrl = apiAccountsIndexUrl + '/' + user

    $('#updateAccount').val(user)

    toggleHiddenFieldWithRadio('manual', _password)

    $.ajax({
        url: apiAccountsShowUrl,
        type: "GET",
        success: function(response) {

            var user = response.data

            $('#_name').val(user.name)
            $('#_email').val(user.email)
        }
    })
});