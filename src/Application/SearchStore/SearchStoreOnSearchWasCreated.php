<?php

declare(strict_types=1);

namespace App\Application\SearchStore;

use App\Domain\SearchRepository;

class SearchStoreOnSearchWasCreated
{
    private SearchRepository $searchRepository;

    public function __construct(
        SearchRepository $searchRepository
    )
    {
        $this->searchRepository = $searchRepository;
    }

    public function __invoke(array $results): void
    {
        $this->searchRepository->save($results);
    }
}