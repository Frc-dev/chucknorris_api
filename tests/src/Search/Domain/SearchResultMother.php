<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Entity\SearchResult;
use Ramsey\Uuid\Uuid;

class SearchResultMother
{
    public static function create(
        string $resultId,
        string $searchId,
        array $categories,
        \DateTimeImmutable $created_at,
        string $value
    ): SearchResult
    {
        return new SearchResult(
            $resultId,
            $searchId,
            $categories,
            $created_at,
            $value
        );
    }

    public static function fromResults($results): SearchResult
    {
        return self::create(
            $results['id'],
            '1234',
            $results['categories'],
            new \DateTimeImmutable($results['created_at']),
            $results['value']
        );
    }

    public static function random(): SearchResult
    {
        return self::create(
            Uuid::uuid4()->toString(),
            '1234',
            ['animal'],
            new \DateTimeImmutable(),
            'chuck norris creo el oceano atlántico de una patada voladora tras tener una mala experiencia en portugal'
        );
    }
}