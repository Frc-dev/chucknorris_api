<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\CategoryGet\CategoryGetQuery;
use App\Domain\Bus\Query\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

class SearchController extends ApiController
{

    private MessageBusInterface $queryBus;
    private MessageBusInterface $commandBus;

    public function __construct(
        MessageBusInterface $queryBus,
        MessageBusInterface $commandBus
    )
    {
        parent::__construct();
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    public function getCategories(): string
    {
        $query = new CategoryGetQuery();

        $result = $this->queryBus->dispatch($query);

        return json_encode($result);
    }

    public function randomSearch(Request $request): void
    {
    }
}