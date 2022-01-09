<?php

declare(strict_types=1);

namespace App\Application\SearchGetResults;

use App\Domain\SearchRepository;

class SearchGetResults
{
    private SearchRepository $repository;

    public function __construct(
        SearchRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(int $offset, int $limit, string $searchId): array
    {
        return $this->repository->getSearch($searchId, $limit, $offset);
    }
}