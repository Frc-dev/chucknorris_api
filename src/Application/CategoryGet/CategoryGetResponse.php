<?php

declare(strict_types=1);

namespace App\Application\CategoryGet;

use App\Domain\Bus\Query\Response;

class CategoryGetResponse implements Response
{
    private array $categoryList;

    public function __construct(
        array $categoryList
    )
    {
        $this->categoryList = $categoryList;
    }

    /**
     * @return array
     */
    public function getCategoryList(): array
    {
        return $this->categoryList;
    }
}