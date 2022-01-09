<?php

declare(strict_types=1);

namespace App\Application\RandomSearch;

use App\ApiRequest;

class RandomSearch
{
    private ApiRequest $apiRequest;

    public function __construct(
        ApiRequest $apiRequest
    )
    {
        $this->apiRequest = $apiRequest;
    }

    public function __invoke(): array
    {
        return $this->apiRequest->randomApiCall();
    }
}