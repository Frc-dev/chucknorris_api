<?php

declare(strict_types=1);

namespace App\Application\RandomSearch;

use App\ApiRequest;
use App\Domain\DomainEvent\SearchWasCreated;
use App\Domain\SearchResultMapper;
use Symfony\Component\Messenger\MessageBusInterface;

class RandomSearch
{
    private ApiRequest $apiRequest;
    private SearchResultMapper $mapper;
    private MessageBusInterface $eventBus;

    public function __construct(
        ApiRequest $apiRequest,
        SearchResultMapper $mapper,
        MessageBusInterface $eventBus
    )
    {
        $this->apiRequest = $apiRequest;
        $this->mapper = $mapper;
        $this->eventBus = $eventBus;
    }

    public function __invoke(): array
    {
        $rawResult = [$this->apiRequest->randomApiCall()];
        $resultCollection = $this->mapper->__invoke($rawResult);

        $event = new SearchWasCreated($resultCollection);
        $this->eventBus->dispatch($event);

        return $resultCollection;
    }
}