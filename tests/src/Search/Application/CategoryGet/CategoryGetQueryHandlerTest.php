<?php

namespace App\Tests\src\Search\Application\CategoryGet;

use App\Application\CategoryGet\CategoryGet;
use App\Application\CategoryGet\CategoryGetQueryHandler;
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
        $result = 'query';
        $this->shouldReturnCategoryList($result);

        $result = $this->handler->__invoke();
        $this->assertEquals('query', $result);
    }
}
