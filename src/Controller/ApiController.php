<?php

declare(strict_types=1);

namespace App\Controller;


use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Query\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class ApiController extends AbstractController
{

    public function __construct(
    ) {
    }

    protected function ask(Query $query): void
    {
    }

    protected function dispatch(Command $command): void
    {
    }
}
