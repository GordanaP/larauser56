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

/**
 * Remove server side validation feedback
 *
 * @param  {array} fields
 * @return {void}
 */
function removeServerSideValidationFeedback(fields)
{
    $.each(fields, function (index, value) {

        var inputId = value.id

        $('input#'+inputId+'.form-control').removeClass('is-invalid')
    })
}