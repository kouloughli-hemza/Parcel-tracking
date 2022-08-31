<?php

namespace Dsone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediteur extends Model
{
    use HasFactory;

    protected $fillable = ['nom','prenom','phone'];

}
