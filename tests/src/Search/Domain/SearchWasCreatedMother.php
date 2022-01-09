<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Domain\DomainEvent\SearchWasCreated;

class SearchWasCreatedMother
{
    public static function create(
        array $results
    ): SearchWasCreated
    {
        return new SearchWasCreated(
            $results
        );
    }
}