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

function getResources()
{
    $resources = [];
    $app_resources = [];
    $vendor_resources = ['Role', 'Permission'];

    $dirs = scandir(app_path());

    foreach ($dirs as $dir) {

        if( $dir !== '.' && $dir !== '..' ) {

            if($dir[-4] === '.') {

                $app_resources[] = substr($dir, 0, -4);
                $resources = array_merge($app_resources, $vendor_resources);
            }
        }
    }

    return $resources;
}

function getPermissions($data)
{
    $permissions = [];

    foreach ($data['permission'] as $permission)
    {
        $permission_name = $permission .'-'. strtolower($data['resource']);

        $permissions[] = $permission_name;
    }

    return $permissions;
}