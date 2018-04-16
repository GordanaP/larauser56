$(document).on('click', '#editAccount', function(){

    editAccountModal.modal('show')

    var user = $(this).val() || $(this).attr('data-user')
    // var adminAccountsEditUrl = adminAccountsUrl + '/' + user + '/edit'
    var editAccountUrl = '/admin/accounts/' + user


    $('#updateAccount').val(user)

    toggleHiddenFieldWithRadio('manual', _password)

    $.ajax({
        url: editAccountUrl,
        type: "GET",
        success: function(response) {

            var user = response.user
            var roleIds = []

            $.each(user.roles, function(key, role) {
                roleIds.push(role.id)
            })

            $("#_role_id").val(roleIds).trigger("change");
            $('#_name').val(user.name)
            $('#_email').val(user.email)
        }
    })
});
