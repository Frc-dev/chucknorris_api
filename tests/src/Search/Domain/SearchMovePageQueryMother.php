<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Application\SearchMovePage\SearchMovePageQuery;

class SearchMovePageQueryMother
{
    public static function create(
        int $limit,
        int $offset,
        string $searchId
    ): SearchMovePageQuery
    {
        return new SearchMovePageQuery(
            $limit,
            $offset,
            $searchId
        );
    }
}