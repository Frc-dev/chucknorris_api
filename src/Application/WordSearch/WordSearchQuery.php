<?php

declare(strict_types=1);

namespace App\Application\WordSearch;

use App\Domain\Bus\Query\Query;

class WordSearchQuery implements Query
{
    private string $word;

    public function __construct(
        string $word
    )
    {
        $this->word = $word;
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }
}