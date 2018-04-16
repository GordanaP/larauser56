$(document).on('click', '#editProfile', function(){

    $('#profileModal').modal('show')
    $('#deleteProfile').hide()

    var user = $(this).attr('data-user') || $(this).val()
    var showProfileUrl = '/admin/profiles/' + user

    $('.modal-title i').addClass('fa-user')
    $('.modal-title span').text(user)
    $('#saveProfile').val(user)
    $('#deleteProfile').val(user)


    $.ajax({
        url: showProfileUrl,
        type: "GET",
        success: function(response) {

            var profile = response.profile

            profile ? $('#deleteProfile').show() : ''
            $('#profileName').val(profile.name)
            $('#about').val(profile.about)
            $('#location').val(profile.location)
        }
    })
})