<?php

declare(strict_types=1);

namespace App\Application\CategoryGet;

use App\ApiRequest;

class CategoryGet
{
    private ApiRequest $apiRequest;

    public function __construct(
        ApiRequest $apiRequest
    )
    {
        $this->apiRequest = $apiRequest;
    }

    public function __invoke(): CategoryGetResponse
    {
        return new CategoryGetResponse($this->apiRequest->categoryListCall());
    }
}