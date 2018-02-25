/**
 * Send user notification.
 *
 * @param  {string} message
 * @param  {string} type
 * @return {mixed}
 */
function userNotification(message, type="success")
{
    return $.notify(message, type)
}

function removeServerSideFeedback(fields)
{
    $.each(fields, function (index, value) {

        var inputId = value.id

        $('input#'+inputId+'.form-control').removeClass('is-invalid')
    })
}