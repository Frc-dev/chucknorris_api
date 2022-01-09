<?php

declare(strict_types=1);

namespace App\Application\CategorySearch;

use App\Domain\Bus\Query\QueryHandler;

class CategorySearchQueryHandler implements QueryHandler
{
    private CategorySearch $categorySearch;

    public function __construct(CategorySearch $categorySearch)
    {
        $this->categorySearch = $categorySearch;
    }

    public function __invoke(CategorySearchQuery $categorySearchQuery): array
    {
        $category = $categorySearchQuery->getCategory();
        return $this->categorySearch->__invoke($category);
    }
}