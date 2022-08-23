<?php

namespace Dsone\Http\Requests\Client;

use Dsone\Http\Requests\Request;

class UpdateClientRequest extends Request
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
             'wilaya_id' => 'nullable|exists:wilayas,id',
             'commune_id' => 'required_with:wilaya_id|exists:communes,id',
         ];

    }
}
