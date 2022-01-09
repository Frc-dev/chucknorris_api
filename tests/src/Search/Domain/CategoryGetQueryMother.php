<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Application\CategoryGet\CategoryGetQuery;

class CategoryGetQueryMother
{
    public static function create(): CategoryGetQuery
    {
        return new CategoryGetQuery();
    }
}