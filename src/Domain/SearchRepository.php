<?php

declare(strict_types=1);

namespace App\Domain;

interface SearchRepository
{
    public function save(array $searchCollection): void;

    public function getSearch(string $searchId, ?int $limit, ?int $offset): ?array;
}