<?php

declare(strict_types=1);

namespace App\Application\WordSearch;

use App\Domain\Bus\Query\QueryHandler;

class WordSearchQueryHandler implements QueryHandler
{
    private WordSearch $searchQuery;

    public function __construct(
        WordSearch $searchQuery
    )
    {
        $this->searchQuery = $searchQuery;
    }

    public function __invoke(WordSearchQuery $query): array
    {
        $word = $query->getWord();
        return $this->searchQuery->__invoke($word);
    }
}