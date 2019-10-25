<?php

namespace App\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersTaskAssignedTo implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        return $query->when($value !== 'null', function ($query) use ($value) {
            return $query->where('assigned_to_id', $value);
        }, function ($query) {
            return $query->whereNull('assigned_to_id');
        });
    }
}