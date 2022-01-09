<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\CategoryGet\CategoryGetQuery;
use App\Application\CategorySearch\CategorySearchQuery;
use App\Application\RandomSearch\RandomSearchQuery;
use App\Application\SearchMovePage\SearchMovePageQuery;
use App\Application\WordSearch\WordSearchQuery;
use App\Domain\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class SearchController extends ApiController
{

    private MessageBusInterface $queryBus;
    private MessageBusInterface $commandBus;
    private ApiResponse $apiResponse;

    public function __construct(
        MessageBusInterface $queryBus,
        MessageBusInterface $commandBus,
        ApiResponse $apiResponse
    )
    {
        parent::__construct();
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->apiResponse = $apiResponse;
    }

    public function getCategories(): Response
    {
        $query = new CategoryGetQuery();

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function categorySearch(string $category): Response
    {
        $query = new CategorySearchQuery($category);

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function randomSearch(): Response
    {
        $query = new RandomSearchQuery();

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function wordSearch(string $word): Response
    {
        $query = new WordSearchQuery($word);

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function searchMovePage(Request $request): Response
    {
        $offset = $request->query->getInt('offset');
        $limit = $request->query->getInt('limit');
        $searchId = $request->get('searchId');
        $query = new SearchMovePageQuery($offset, $limit, $searchId);

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }
}