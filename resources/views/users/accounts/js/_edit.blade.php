$(document).on('click', '#editAccount', function() {

    accountModal.modal('show')

    var user = $(this).val()
    var apiAccountsShowUrl = apiAccountsIndexUrl + '/' + user

    $('.modal-title i').addClass('fa-lock')
    $('.modal-title span').text('Edit account')
    $('.btn-account').attr('id','updateAccount').text('Save changes').val(user) // asign user id(slug) to btn value

    $.ajax({
        url: apiAccountsShowUrl,
        type: "GET",
        success: function(response) {

            var user = response.data

            $('#name').val(user.name)
            $('#email').val(user.email)
        }
    })
});