<?php

/**
 * Create the response message.
 *
 * @param  string  $message
 * @param  string  $type
 * @return array
 */
function message($message, $type="success")
{
    $response['message'] = $message;
    $response['type'] = $type;

    return $response;
}


function set_active_link($value, $segment=1)
{
    return request()->segment($segment) == $value ? 'active' : '';
}


function set_class($param, $value, $class1=' green', $class2=' red')
{
    return $param == $value ? $class1 : $class2;
}

function selected($current, $selected)
{
    return $current == $selected ? 'selected' : '';
}

function setAvatar($user)
{
    $avatar = $user->avatar ? $user->avatar->filename : 'default.jpg';

    return 'images/avatars/'.$avatar;
}