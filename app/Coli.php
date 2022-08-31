<?php

namespace Dsone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Coli extends Model
{
    use HasFactory;

    protected $fillable = [
        'description_produit',
        'poids',
        'prix_unitaire',
        'tracking_number',
        'shipping_type',
        'shipping_cost',
        'note',
        'client_id',
        'facture_id',
        'expediteur_id',
    ];

    protected $dates = ['created_at'];


    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }


    /**
     * @return BelongsTo
     */
    public function facture(): BelongsTo
    {
        return $this->belongsTo(Facture::class);
    }


    /**
     * @return BelongsTo
     */
    public function expediteur(): BelongsTo
    {
        return $this->belongsTo(Expediteur::class);
    }



    /**
     * @return mixed
     */
    public function getNextId()
    {
        $statement = DB::select("show table status like 'colis'");

        return $statement[0]->Auto_increment;
    }



}
