<?php

namespace Dsone\Http\Requests\User;

use Dsone\Http\Requests\Request;

class UploadAvatarRawRequest extends Request
{
    public function rules()
    {
        return [
            'file' => 'required|image'
        ];
    }
}
