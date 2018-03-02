$(document).on('click', '#editRole', function() {

    roleModal.modal('show')
    var role = $(this).val()

    $('.modal-title i').addClass('fa-briefcase')
    $('.modal-title span').text('Edit role')
    $('.btn-role').attr('id', 'updateRole').text('Save changes').val(role)

    var role = $(this).val()
    var adminRolesShowUrl =  adminRolesIndexUrl + '/' + role

    $.ajax({
        url: adminRolesShowUrl,
        type: "GET",
        success: function(response) {

            var role = response.role

            $('#name').val(role.name)
        }
    })
})