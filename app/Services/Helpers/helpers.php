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
    $vendor_resources = ['role', 'permission'];

    $dirs = scandir(app_path());

    foreach ($dirs as $dir) {

        if( $dir !== '.' && $dir !== '..' ) {

            if($dir[-4] === '.') {

                $app_resources[] = strtolower(substr($dir, 0, -4));
                $resources = array_merge($app_resources, $vendor_resources);
            }
        }
    }

    return $resources;
}

function getPermissionsNames($data)
{
    $permissions = [];

    foreach ($data['permission'] as $permission)
    {
        $permission_name = $permission .'-'. $data['resource'];

        $permissions[] = $permission_name;
    }

    return $permissions;
}

function getPermissionName($data) {

    return $data['permission'] .'-'. $data['resource'];
}

