<?php

namespace App\Http\Requests\Role;

use App\Services\Utilities\Cruds;
use App\Services\Utilities\Resources;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resource' => [
                'required',
                Rule::in(array_values(Resources::all())),
            ],
            'permission' => [
                'required', 'array', 'max:'.sizeof(Cruds::all()),
                Rule::in(array_keys(Cruds::all())),
            ],
            'permission.*' => 'distinct'
        ];
    }
}
