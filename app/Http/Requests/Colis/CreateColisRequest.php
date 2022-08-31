<?php

namespace Dsone\Http\Requests\Colis;

use Dsone\Http\Requests\Request;
use Dsone\Support\Enum\SendTypes;
use Illuminate\Validation\Rule;

class CreateColisRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
         return [
                //Client
                'nom' => 'required',
                'prenom' => 'required',
                'tel' => 'required',
                'adresse' => 'required',
                'commune_id' => 'required|exists:communes,id',
                'wilaya_id' => 'required|exists:wilayas,id',
                //Parcel
                'description_produit' => 'nullable',
                'poids' => 'nullable',
                'prix_unitaire' => 'nullable',
                'shipping_type' => [
                    'required',
                    Rule::in(array_keys(SendTypes::lists())),
                ],
             'shipping_cost' => 'required|numeric|min:0'
        ];

    }
}
