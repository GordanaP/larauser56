$(document).on('click', '#deleteProfile', function(){

    var user = $(this).val()
    var deleteProfileUrl = '/admin/profiles/' + user

    $.ajax({
        url: deleteProfileUrl,
        type: "DELETE",
        success: function(response) {
            successResponse(profileModal, response.message)
        }
    })
})