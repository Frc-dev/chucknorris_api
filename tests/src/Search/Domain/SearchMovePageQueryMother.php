<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Application\SearchGetResults\SearchGetResultsQuery;

class SearchMovePageQueryMother
{
    public static function create(
        int $limit,
        int $offset,
        string $searchId
    ): SearchGetResultsQuery
    {
        return new SearchGetResultsQuery(
            $limit,
            $offset,
            $searchId
        );
    }
}