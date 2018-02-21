/**
 * Notify user about a successful action
 *
 * @param  {string} message
 * @param  {string} type
 * @return {mixed}
 */
function successNotification(message, type="success")
{
    return $.notify(message, type)
}
