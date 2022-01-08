<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Domain\SearchResult;

class SearchResultMother
{
    public static function create(
        string $created_at,
        string $icon_url,
        string $id,
        string $updated_at,
        string $url,
        string $value,
        array $categories = []
    ): SearchResult
    {
        return new SearchResult(
            $categories,
            $created_at,
            $icon_url,
            $id,
            $updated_at,
            $url,
            $value
        );
    }

    public static function fromResults($results): SearchResult
    {
        return self::create(
            $results['created_at'],
            $results['icon_url'],
            $results['id'],
            $results['updated_at'],
            $results['url'],
            $results['value'],
            $results['categories']
        );
    }
}