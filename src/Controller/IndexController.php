<?php

declare(strict_types=1);

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ApiController
{

    #[Route('/')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('homepage', ['_locale' => 'en']);
    }

    #[Route('/{_locale<en|es>}/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('views/index.html.twig');
    }
}