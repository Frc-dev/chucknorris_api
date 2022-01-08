<?php

declare(strict_types=1);

namespace App\Application\RandomSearch;

use App\Domain\Bus\Command\CommandHandler;

class RandomSearchCommandHandler implements CommandHandler
{
    private RandomSearch $randomQuery;

    public function __construct(
        RandomSearch $randomQuery
    )
    {
        $this->randomQuery = $randomQuery;
    }

    public function __invoke(RandomSearchCommand $command): string
    {
        return $this->randomQuery->__invoke();
    }
}