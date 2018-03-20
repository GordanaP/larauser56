<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\Resource;

class UsersCollection extends Resource
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
            'roles' => $this->roles->count() ? $this->roles->pluck('name') : '',
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->accountStatus(),
            'joined' => $this->formatted_date,
            'user' => $this->slug,
        ];
    }
}