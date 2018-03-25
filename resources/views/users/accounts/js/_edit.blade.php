$(document).on('click', '#editAccount', function(){

    editAccountModal.modal('show')

    var user = $(this).val()
    var adminAccountsEditUrl = adminAccountsUrl + '/' + user + '/edit'

    $('#updateAccount').val(user)

    toggleHiddenFieldWithRadio('manual', _password)

    $.ajax({
        url: adminAccountsEditUrl,
        type: "GET",
        success: function(response) {

            var user = response.data
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
