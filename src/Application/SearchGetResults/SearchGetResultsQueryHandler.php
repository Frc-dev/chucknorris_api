<?php

declare(strict_types=1);

namespace App\Application\SearchGetResults;

use App\Domain\Bus\Query\QueryHandler;

class SearchGetResultsQueryHandler implements QueryHandler
{
    private SearchGetResults $searchMovePage;

    public function __construct(
        SearchGetResults $searchMovePage
    )
    {
        $this->searchMovePage = $searchMovePage;
    }

    public function __invoke(SearchGetResultsQuery $query): array
    {
        $offset = $query->getOffset();
        $limit = $query->getLimit();
        $searchId = $query->getSearchId();

        return $this->searchMovePage->__invoke($offset, $limit, $searchId);
    }
}