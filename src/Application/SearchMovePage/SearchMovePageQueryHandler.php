<?php

declare(strict_types=1);

namespace App\Application\SearchMovePage;

use App\Domain\Bus\Query\QueryHandler;

class SearchMovePageQueryHandler implements QueryHandler
{
    private $searchMovePage;

    public function __construct(
        SearchMovePage $searchMovePage
    )
    {
        $this->searchMovePage = $searchMovePage;
    }

    public function __invoke(SearchMovePageQuery $query): array
    {
        $offset = $query->getOffset();
        $limit = $query->getLimit();
        $searchId = $query->getSearchId();

        return $this->searchMovePage->__invoke($offset, $limit, $searchId);
    }
}