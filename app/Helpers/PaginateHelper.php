<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class PaginateHelper
{
    /**
     * Menjalankan pagination untuk query Eloquent.
     */
    public static function paginate(
        Builder $query,
        int $perPage = 10,
        string $pageName = 'page'
    ): LengthAwarePaginator {
        return $query
            ->paginate($perPage, ['*'], $pageName)
            ->withQueryString();
    }
}
