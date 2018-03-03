<?php

namespace App\Http\Resources\Permission;

use Illuminate\Http\Resources\Json\Resource;

class PermissionCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'created' => $this->created_at->toFormattedDateString(),
            'permission' => $this->id
        ];
    }
}
