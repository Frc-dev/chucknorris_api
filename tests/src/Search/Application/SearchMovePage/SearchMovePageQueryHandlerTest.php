<?php

namespace App\Tests\src\Search\Application\SearchMovePage;

use App\Application\SearchMovePage\SearchMovePage;
use App\Application\SearchMovePage\SearchMovePageQueryHandler;
use App\Tests\src\Search\Domain\SearchMovePageQueryMother;
use App\Tests\src\Search\Domain\SearchUnitTestCase;

class SearchMovePageQueryHandlerTest extends SearchUnitTestCase
{
    private $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new SearchMovePageQueryHandler(
            new SearchMovePage(
                $this->repository()
            )
        );
    }

    /** @test */
    public function should_search_results(): void
    {
        $searchId = '1234';
        $limit = 10;
        $offset = 40;
        $result = ['datos'];
        $query = SearchMovePageQueryMother::create($offset, $limit, $searchId);

        $this->shouldSearchResults($result);
        $this->assertEquals($result, $this->handler->__invoke($query));
    }
}
