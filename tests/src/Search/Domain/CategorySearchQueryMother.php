<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Application\CategorySearch\CategorySearchQuery;

class CategorySearchQueryMother
{
    public static function create(
        string $category
    ): CategorySearchQuery
    {
        return new CategorySearchQuery(
            $category
        );
    }
}