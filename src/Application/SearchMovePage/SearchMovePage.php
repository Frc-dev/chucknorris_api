<?php

declare(strict_types=1);

namespace App\Application\SearchMovePage;

use App\Domain\SearchRepository;

class SearchMovePage
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