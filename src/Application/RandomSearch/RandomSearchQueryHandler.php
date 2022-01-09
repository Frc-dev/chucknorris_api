<?php

declare(strict_types=1);

namespace App\Application\RandomSearch;

use App\Domain\Bus\Query\QueryHandler;

class RandomSearchQueryHandler implements QueryHandler
{
    private RandomSearch $randomQuery;

    public function __construct(
        RandomSearch $randomQuery
    )
    {
        $this->randomQuery = $randomQuery;
    }

    public function __invoke(RandomSearchQuery $query): array
    {
        return $this->randomQuery->__invoke();
    }
}