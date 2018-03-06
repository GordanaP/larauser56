$(document).on('click', '#editPermission', function() {

    editPermissionModal.modal('show')

    var permission = $(this).val()
    var apiPermissionsShowUrl = apiPermissionsIndexUrl + '/' + permission

    $('.btn-permission').val(permission)

    $.ajax({
        url: apiPermissionsShowUrl,
        type: "GET",
        success: function(response) {

            var name = response.data.permission  //create-user
            var splitted = name.split("-")  // ['create', 'user']

            var permission = splitted[0]  // create
            var resource = splitted[1]  // user

            $('#resource').val(resource)
            $("#permission-"+permission).val(permission).prop('checked', true)
        }
    })
})