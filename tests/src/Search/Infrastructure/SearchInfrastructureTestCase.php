<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Infrastructure;

use App\Domain\SearchRepository;
use App\Tests\src\Shared\Infrastructure\InfrastructureTestCase;

class SearchInfrastructureTestCase extends InfrastructureTestCase
{
    protected function repository(): SearchRepository
    {
        return $this->service(SearchRepository::class);
    }
}