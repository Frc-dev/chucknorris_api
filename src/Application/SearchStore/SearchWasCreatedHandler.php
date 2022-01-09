<?php

declare(strict_types=1);

namespace App\Application\SearchStore;

use App\Domain\DomainEvent\SearchWasCreated;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SearchWasCreatedHandler implements MessageHandlerInterface
{
    private SearchStoreOnSearchWasCreated $searchStore;

    public function __construct(SearchStoreOnSearchWasCreated $searchStore)
    {
        $this->searchStore = $searchStore;
    }

    public function __invoke(SearchWasCreated $event): void
    {
        $results = $event->getResults();

        $this->searchStore->__invoke($results);
    }
}