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


/**
 * Notify user about a failed action
 *
 * @param  {string} message
 * @param  {string} type
 * @return {mixed}
 */
function errorNotification(message, type="error")
{
    return $.notify(message, type)
}
