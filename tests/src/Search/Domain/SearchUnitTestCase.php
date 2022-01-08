<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\ApiRequest;
use App\Application\CategoryGet\CategoryGet;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class SearchUnitTestCase extends UnitTestCase
{
    private $apiRequest;

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
}