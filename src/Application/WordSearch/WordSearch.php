<?php

declare(strict_types=1);

namespace App\Application\WordSearch;

use App\ApiRequest;
use App\Domain\DomainEvent\SearchWasCreated;
use App\Domain\SearchResultMapper;
use Symfony\Component\Messenger\MessageBusInterface;

class WordSearch
{
    private ApiRequest $apiRequest;
    private MessageBusInterface $eventBus;
    private SearchResultMapper $mapper;

    public function __construct(
        ApiRequest $apiRequest,
        MessageBusInterface $eventBus,
        SearchResultMapper $mapper
    )
    {
        $this->apiRequest = $apiRequest;
        $this->eventBus = $eventBus;
        $this->mapper = $mapper;
    }

    public function __invoke(string $word): array
    {
        $word = filter_var($word, FILTER_SANITIZE_STRING);
        $results = $this->apiRequest->wordSearchCall($word);
        $resultCollection = $this->mapper->__invoke($results['result']);


        $event = new SearchWasCreated($resultCollection);
        $this->eventBus->dispatch($event);

        return array_slice($resultCollection, 0, 10);
    }
}