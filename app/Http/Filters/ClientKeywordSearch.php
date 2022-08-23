<?php

namespace Dsone\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ClientKeywordSearch implements Filter
{
    public function __invoke(Builder $query, $search, string $property = '')
    {
        $query->where(function ($q) use ($search) {
            $q->orWhere('nom', 'like', "%{$search}%");
            $q->orWhere('prenom', 'like', "%{$search}%");
            $q->orWhere('adresse', 'like', "%{$search}%");
        });
    }
}
