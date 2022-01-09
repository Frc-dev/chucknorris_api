<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Infrastructure;

use App\ApiRequest;
use App\Domain\DomainError\WrongCategoryException;
use App\Entity\SearchResult;
use App\Tests\src\Search\Domain\SearchResultMother;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $results = $client->randomApiCall();
        $searchResult = SearchResultMother::fromResults($results);

        $this->assertInstanceOf(SearchResult::class, $searchResult);
    }

    /** @test */
    public function shouldReturnCategoryList()
    {
        $client = $this->apiRequest;
        $results = $client->categoryListCall();

        $this->assertIsArray($results);
    }

    /** @test */
    public function shouldReturnCategorySearch()
    {
        $client = $this->apiRequest;
        $results = $client->categorySearchCall('animal');
        $searchResult = SearchResultMother::fromResults($results);

        $this->assertInstanceOf(SearchResult::class, $searchResult);
    }

    /** @test */
    public function shouldReturnWordedSearch()
    {
        $client = $this->apiRequest;
        $results = $client->wordSearchCall('norris');
        $searchResult = SearchResultMother::fromResults($results['result'][0]);

        $this->assertInstanceOf(SearchResult::class, $searchResult);
    }

    /** @test */
    public function shouldThrowExceptionForNonExistantCategory()
    {
        $client = $this->apiRequest;
        $this->expectException(NotFoundHttpException::class);
        $client->categorySearchCall('motorsports');
    }

    public function wrongCategoryValues(): array
    {
        return [
            [';DROP TABLES'],
            ['~~#@½#@½¬'],
            ['<script type="text/javascript">document.location="veryshadywebsite";</script>']
        ];
    }

    /**
     * @test
     * @dataProvider wrongCategoryValues
     */
    public function shouldThrowExceptionWhenCategoryIsWrong(
        string $wrongCategory
    )
    {
        $client = $this->apiRequest;
        $this->expectException(WrongCategoryException::class);
        $client->categorySearchCall($wrongCategory);
    }
}