<?php

declare(strict_types=1);

namespace App\Application\CategorySearch;

use App\ApiRequest;
use App\Domain\DomainEvent\SearchWasCreated;
use App\Domain\SearchResultMapper;
use Symfony\Component\Messenger\MessageBusInterface;

class CategorySearch
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

    public function __invoke(string $category): array
    {
        $rawResult = [$this->apiRequest->categorySearchCall($category)];
        $resultCollection = $this->mapper->__invoke($rawResult);

        $event = new SearchWasCreated($resultCollection);
        $this->eventBus->dispatch($event);

        return $resultCollection;
    }
}