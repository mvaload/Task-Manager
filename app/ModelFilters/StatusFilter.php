<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class StatusFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    /**
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        return $this->whereLike('name', $name);
    }
}
