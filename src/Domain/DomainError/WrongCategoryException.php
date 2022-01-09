<?php

declare(strict_types=1);

namespace App\Domain\DomainError;

class WrongCategoryException extends DomainError
{
    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return '400';
    }

    protected function errorMessage(): string
    {
        return sprintf('%s is not a valid category', $this->category);
    }
}