<?php

declare(strict_types=1);

namespace App\Domain\DomainEvent;

class SearchWasCreated
{
    private array $results;

    public function __construct(
        array $results
    )
    {
        $this->results = $results;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }
}