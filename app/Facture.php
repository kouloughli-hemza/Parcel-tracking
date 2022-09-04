<?php

namespace Dsone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = ['reference','total_coli','total_ttc','sur_facture','total_shipping','net_amount','expediteur_id'];


    /**
     * @return BelongsTo
     */
    public function expedireur(): BelongsTo
    {
        return $this->belongsTo(Expediteur::class,'expediteur_id');
    }


    /**
     * @return HasMany
     */
    public function colis(): HasMany
    {
        return $this->hasMany(Coli::class);
    }


    /**
     * @return mixed
     */
    public function getNextId()
    {
        $statement = DB::select("show table status like 'factures'");

        return $statement[0]->Auto_increment;
    }
}
