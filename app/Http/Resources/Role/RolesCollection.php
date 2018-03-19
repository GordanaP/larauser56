<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\Resource;

class RolesCollection extends Resource
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
            'created' => $this->formated_date,
            'role' => $this->slug,
        ];
    }
}
