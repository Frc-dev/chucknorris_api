<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Application\RandomSearch\RandomSearchQuery;

class RandomSearchQueryMother
{
    public static function create(): RandomSearchQuery
    {
        return new RandomSearchQuery();
    }
}