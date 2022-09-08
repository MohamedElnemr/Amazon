<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;

class FilterHelper
{

    public static function apply(Builder $query, $conditions)
    {
        if (isset($conditions['keyword'])) {
            $keyword = $conditions['keyword'];
            $query = $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('category', function ($item) use ($keyword) {
                    $item->where('name', 'LIKE', '%' . $keyword . '%');
                });
            unset($conditions['keyword']);
        }
        $relation_ids = array_filter(array_keys($conditions), function ($key) {
            return strpos($key, '_ids') !== false;
        });
        if (count($relation_ids)) {
            foreach ($relation_ids as $key => $relation) {
                $ids = explode( ',' ,$conditions[$relation] );
                $relation_name = str_replace('_ids','',$relation);
                $query->whereHas($relation_name, function ($q) use ( $ids) {
                                return $q->whereIn('id', $ids);
                            });
                unset($conditions[$relation]);
            }
        }
        return $query;

    }
}
