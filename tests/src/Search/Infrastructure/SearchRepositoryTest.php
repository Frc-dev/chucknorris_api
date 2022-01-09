<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Infrastructure;

use App\Tests\src\Search\Domain\SearchResultMother;

class SearchRepositoryTest extends SearchInfrastructureTestCase
{

    public function searchSaveValues(): array
    {
        return [
            [[SearchResultMother::random()]],
            [[SearchResultMother::random(),SearchResultMother::random(),SearchResultMother::random(),SearchResultMother::random(),SearchResultMother::random()]]
        ];
    }

    /**
     * @dataProvider searchSaveValues
     * @test
     */
    public function should_save_search_and_find_it(
        array $searchResults
    ): void
    {
        $searchId = $searchResults[0]->getSearchId();
        $this->repository()->save($searchResults);
        $this->flush();
        $result = $this->repository()->getSearch($searchId);
        $this->assertIsArray($result);
        $this->assertEquals($result[0]->getSearchId(), $searchId);
    }
}
