<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Application\RandomSearch;

use App\Application\RandomSearch\RandomSearch;
use App\Application\RandomSearch\RandomSearchQueryHandler;
use App\Tests\src\Search\Domain\RandomSearchQueryMother;
use App\Tests\src\Search\Domain\SearchUnitTestCase;

class RandomSearchQueryHandlerTest extends SearchUnitTestCase
{
    private RandomSearchQueryHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new RandomSearchQueryHandler(
            new RandomSearch(
                $this->apiRequest()
            )
        );
    }

    /** @test */
    public function should_get_random_result()
    {
        $result = 'query';
        $query = RandomSearchQueryMother::create();
        $this->shouldReturnRandomResult($result);

        $this->assertEquals('query', $this->handler->__invoke($query));
    }
}