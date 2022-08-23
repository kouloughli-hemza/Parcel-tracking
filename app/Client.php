<?php

namespace Dsone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

class Client extends Model
{
    use HasFactory;


    protected $fillable = ['nom','prenom','tel','adresse','wilaya_id','commune_id'];


    /**
     * @return BelongsTo
     */
    public function wilaya(): BelongsTo
    {
        return $this->belongsTo(Wilaya::class,'wilaya_id');
    }

    /**
     * @return BelongsTo
     */
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class,'commune_id');
    }
}
