<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Infrastructure;

use App\ApiRequest;
use App\Domain\SearchResult;
use App\Tests\src\Search\Domain\SearchResultMother;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\NativeHttpClient;

class ApiRequestTest extends WebTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiRequest = new ApiRequest(
            new NativeHttpClient()
        );
    }

    /** @test */
    public function shouldTestRandomCall()
    {
        $client = $this->apiRequest;
        $results = json_decode($client->randomApiCall(), true);
        $searchResult = SearchResultMother::fromResults($results);

        $this->assertInstanceOf(SearchResult::class, $searchResult);
    }

    /** @test */
    public function shouldReturnCategoryList()
    {
        $client = $this->apiRequest;
        $results = json_decode($client->categoryListCall(), true);

        $this->assertIsArray($results);
    }
}