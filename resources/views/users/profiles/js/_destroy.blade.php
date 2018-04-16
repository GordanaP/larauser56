$(document).on('click', '#destroyProfile', function(){

    var user = $(this).val()
    var deleteProfileUrl = '/admin/profiles/' + user

    $.ajax({
        url: deleteProfileUrl,
        type: "DELETE",
        success: function(response) {
            userNotification(response.message)
            $('#myProfile').load(location.href + " #myProfile")
        }
    })
})