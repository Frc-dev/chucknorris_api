<?php

declare(strict_types=1);

namespace App\Tests\src\Search\Domain;

use App\Application\WordSearch\WordSearchQuery;

class WordSearchQueryMother
{
    public static function create(
        string $word
    ): WordSearchQuery
    {
        return new WordSearchQuery($word);
    }
}