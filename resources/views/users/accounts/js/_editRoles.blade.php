$(document).on('click', '#editRoles', function() {

    var user = $(this).attr('data-user');
    // var UserRolesUrl = '/admin/accounts/' + user + '/edit'
    var UserRolesUrl = '/admin/accounts/' + user

    revokeRolesModal.modal("show")

    $(".modal-title span").text(user)
    $("#revokeRoles").val(user) // attach user

    $.ajax({
        url: UserRolesUrl,
        type: "GET",
        success: function(response) {
            $('#role').html(response.html);
        }
    })
})
