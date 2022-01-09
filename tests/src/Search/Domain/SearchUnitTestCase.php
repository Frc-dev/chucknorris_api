<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\ApiRequest;
use App\Domain\SearchRepository;
use App\Domain\SearchResultMapper;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class SearchUnitTestCase extends UnitTestCase
{
    private $repository;
    private $apiRequest;
    private $searchResultMapper;

    /** @return SearchRepository|MockObject */
    protected function repository(): MockObject
    {
        return $this->repository = $this->repository ?: $this->mock(SearchRepository::class);
    }

    protected function shouldSearchResults($result): void
    {
        $this->repository()
            ->expects(self::once())
            ->method('getSearch')
            ->willReturn($result);
    }

    /** @return ApiRequest|MockObject */
     protected function apiRequest(): MockObject
     {
        return $this->apiRequest = $this->apiRequest ?: $this->mock(ApiRequest::class);
     }

     protected function shouldReturnRandomResult($result): void
     {
         $this->apiRequest()
             ->expects(self::once())
             ->method('randomApiCall')
             ->willReturn($result);
     }

    protected function shouldReturnCategoryList($result): void
    {
        $this->apiRequest()
            ->expects(self::once())
            ->method('categoryListCall')
            ->willReturn($result);
    }

    protected function shouldReturnCategorySearch($result): void
    {
        $this->apiRequest()
            ->expects(self::once())
            ->method('categorySearchCall')
            ->willReturn($result);
    }

    protected function shouldReturnWordedSearch($result): void
    {
        $this->apiRequest()
            ->expects(self::once())
            ->method('wordSearchCall')
            ->willReturn($result);
    }

    /** @return SearchResultMapper|MockObject */
    protected function searchResultMapper(): MockObject
    {
        return $this->searchResultMapper = $this->searchResultMapper ?: $this->mock(SearchResultMapper::class);
    }

    protected function shouldMapSearchResults($resultCollection): void
    {
        $this->searchResultMapper()
            ->expects(self::once())
            ->method('__invoke')
            ->willReturn($resultCollection);
    }
}