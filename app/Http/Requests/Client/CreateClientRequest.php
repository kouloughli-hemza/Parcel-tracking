<?php

namespace Dsone\Http\Requests\Client;

use Dsone\Http\Requests\Request;

class CreateClientRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
         return [
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
            'adresse' => 'required',
            'commune_id' => 'required|exists:communes,id',
            'wilaya_id' => 'required|exists:wilayas,id',
        ];

    }
}
