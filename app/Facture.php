<?php

namespace Dsone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = ['reference','total_coli','total_ttc','sur_facture','net_amount','expediteur_id'];


    /**
     * @return BelongsTo
     */
    public function expedireur(): BelongsTo
    {
        return $this->belongsTo(Expediteur::class);
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
