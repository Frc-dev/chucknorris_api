<?php

declare(strict_types=1);

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class IndexController extends ApiController
{
    public function index(): Response
    {
        return $this->render('views/index.html.twig');
    }
}