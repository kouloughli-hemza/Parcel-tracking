<?php

namespace Dsone\Http\Requests\User;

use Illuminate\Validation\Rule;
use Dsone\Http\Requests\Request;
use Dsone\Support\Enum\UserStatus;
use Dsone\User;

class UpdateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();

        return [
            'email' => 'email|unique:users,email,' . $user->id,
            'username' => 'nullable|unique:users,username,' . $user->id,
            'password' => 'min:6|confirmed',
            'birthday' => 'nullable|date',
            'role_id' => 'exists:roles,id',
            'country_id' => 'exists:countries,id',
            'status' => Rule::in(array_keys(UserStatus::lists()))
        ];
    }
}
