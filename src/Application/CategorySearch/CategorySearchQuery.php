<?php

declare(strict_types=1);

namespace App\Application\CategorySearch;

use App\Domain\Bus\Query\Query;

class CategorySearchQuery implements Query
{
    private string $category;

    public function __construct(
        string $category
    )
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}