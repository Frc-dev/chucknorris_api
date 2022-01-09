<?php

namespace App\Tests\src\Search\Application\CategoryGet;

use App\Application\CategoryGet\CategoryGet;
use App\Application\CategoryGet\CategoryGetQueryHandler;
use App\Tests\src\Search\Domain\CategoryGetQueryMother;
use App\Tests\src\Search\Domain\SearchUnitTestCase;

class CategoryGetQueryHandlerTest extends SearchUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new CategoryGetQueryHandler(
            new CategoryGet(
                $this->apiRequest()
            )
        );
    }

    /** @test */
    public function should_get_category_list()
    {
        $query = CategoryGetQueryMother::create();
        $result = ['query'];
        $this->shouldReturnCategoryList($result);

        $this->assertEquals($result, $this->handler->__invoke($query));
    }
}
