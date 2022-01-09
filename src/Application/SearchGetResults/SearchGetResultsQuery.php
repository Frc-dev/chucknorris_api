<?php

declare(strict_types=1);

namespace App\Application\SearchGetResults;

use App\Domain\Bus\Query\Query;

class SearchGetResultsQuery implements Query
{
    private int $offset;
    private int $limit;
    private string $searchId;

    public function __construct(
        int $offset,
        int $limit,
        string $searchId
    )
    {
        $this->offset = $offset;
        $this->limit = $limit;
        $this->searchId = $searchId;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return string
     */
    public function getSearchId(): string
    {
        return $this->searchId;
    }
}