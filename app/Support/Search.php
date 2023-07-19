<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Validator;

trait Search
{

    protected $operators = [
        'equal_to' => '=',
        'not_equal' => '<>',
        'less_than' => '<',
        'greater_than' => '>',
        'less_than_or_equal_to' => '<=',
        'greater_than_or_equal_to' => '>=',
        'in' => 'IN',
        'not_in' => 'NOT IN',
        'like' => 'LIKE',
        'between' => 'BETWEEN'
    ];

    public function scopeSearch($query)
    {
        $this->validate([
            'sort_column' => 'sometimes|required',
            'sort_direction' => 'sometimes|required|in:asc,desc',

            'pagination' => 'sometimes|required|in:on,off',
            'limit' => 'sometimes|required_if:pagination,off|integer|min:1',
            'per_page' => 'sometimes|required|integer|min:1',
            'page' => 'sometimes|required|integer|min:1',

            'q' => 'sometimes|max:200', // simple search

            // advanced multi-column filter
            'filters' => 'sometimes|required|array',
            'filters.*.column' => 'required',
            'filters.*.operator' => 'required_with:filters.*.column|in:' . $this->allowedOperators(),
            'filters.*.query_1' => 'required_with:filters.*.operator|string',
            'filters.*.query_2' => 'required_if:filters.*.operator,between|string'
        ]);

        if (request()->has('filters')) {
            // filter
            foreach (request('filters', []) as $filter) {
                $this->applyFilter($filter, $query);
            }
        } else {
            // search if?
            $query->when(request('q', null), function ($query) {
                foreach ($this->search as $fields) {
                    $query->orWhere($fields, 'like', '%' . request('q') . '%');
                }
            });
        }
        if (in_array("created_at", $this->columns)) {
            $query->orderBy(
                request('sort_column', 'created_at'),
                request('sort_direction', 'desc')
            );
        }

        if (request('pagination', 'on') == 'off') {
            if (request()->has('limit')) {
                $query->limit(request('limit'));
            }

            return $query->get();
        } else {
            return $query->paginate(
                request('per_page', env('PER_PAGE', 50))
            );
        }
    }

    protected function validate($rules)
    {
        $v = Validator::make(request()->all(), $rules);

        if ($v->fails()) {
            if (env('APP_ENV') == 'local') {
                // return dd($v->messages()->all());
            }

            throw new ValidationException($v);
        }
    }

    protected function allowedOperators()
    {
        return implode(
            ',',
            array_keys($this->operators)
        );
    }

    protected function applyFilter($filter, $parentQuery)
    {
        if (strpos($filter['column'], '.') !== false) {
            $rel = explode(".", $filter['column']);
            // $parentQuery->with($rel[0]);
            $parentQuery->whereHas($rel[0], function (Builder $subquery) use ($rel, $filter) {
                switch ($filter['operator']) {
                    case "like":
                        $subquery->where($rel[1], $this->findOperator($filter['operator']), '%' . $filter['query_1'] . '%');
                        break;
                }
            });
        } else {
            $this->searchQuery($filter, $parentQuery);
        }
        return $parentQuery;
    }

    protected function findOperator($operator)
    {
        return $this->operators[$operator];
    }

    protected function searchQuery($filter, $parentQuery)
    {
        switch ($filter['operator']) {
            case 'equal_to':
            case 'not_equal':
            case 'less_than':
            case 'greater_than':
            case 'less_than_or_equal_to':
            case 'greater_than_or_equal_to':
                $parentQuery->where(
                    $filter['column'],
                    $this->findOperator($filter['operator']),
                    $filter['query_1']
                );
                break;

            case 'in':
                $parentQuery->whereIn(
                    $filter['column'],
                    explode(',', $filter['query_1'])
                );
                break;

            case 'not_in':
                $parentQuery->whereNotIn(
                    $filter['column'],
                    explode(',', $filter['query_1'])
                );
                break;

            case 'like':
                $parentQuery->where(
                    $filter['column'],
                    'like',
                    '%' . $filter['query_1'] . '%'
                );
                break;

            case 'between':
                $parentQuery->whereBetween($filter['column'], [
                    $filter['query_1'],
                    $filter['query_2']
                ]);
                break;

            default:
                throw new Exception('Invalid Search operator', 1);
                break;
        }

        return $parentQuery;
    }

    protected function whiteListColumns()
    {
        return implode(',', $this->columns);
    }
}
