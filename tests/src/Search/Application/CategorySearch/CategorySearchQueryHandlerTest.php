<?php

namespace App\Tests\src\Search\Application\CategorySearch;

use App\Application\CategorySearch\CategorySearch;
use App\Application\CategorySearch\CategorySearchQueryHandler;
use App\Tests\src\Search\Domain\CategorySearchQueryMother;
use App\Tests\src\Search\Domain\SearchResultMother;
use App\Tests\src\Search\Domain\SearchUnitTestCase;
use App\Tests\src\Search\Domain\SearchWasCreatedMother;

class CategorySearchQueryHandlerTest extends SearchUnitTestCase
{
    private CategorySearchQueryHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new CategorySearchQueryHandler(
            new CategorySearch(
                $this->apiRequest(),
                $this->searchResultMapper(),
                $this->eventBus()
            )
        );
    }

    /** @test */
    public function should_return_search_result()
    {
        $apiResult = ['cosas'];
        $searchResult = SearchResultMother::random();
        $result = [$searchResult];
        $query = CategorySearchQueryMother::create('animal');

        $this->shouldReturnCategorySearch($apiResult);
        $this->shouldMapSearchResults($result);
        $this->shouldDispatchDomainEvent(SearchWasCreatedMother::create(
            $result
        ));

        $this->assertEquals($result, $this->handler->__invoke($query));
    }
}
