<?php

declare(strict_types=1);

namespace App\Application\CategoryGet;

use App\Domain\Bus\Query\QueryHandler;

class CategoryGetQueryHandler implements QueryHandler
{
    private CategoryGet $categoryGet;

    public function __construct(
        CategoryGet $categoryGet
    )
    {
        $this->categoryGet = $categoryGet;
    }

    public function __invoke(CategoryGetQuery $categoryGetQuery): array
    {
        return $this->categoryGet->__invoke();
    }
}