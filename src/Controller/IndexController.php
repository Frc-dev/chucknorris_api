<?php

declare(strict_types=1);

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ApiController
{TODO
NO FUNCIONA EL EVENT HANDLER
CONFIGURAR MAILER, TIENE QUE USAR EL EVENT HANDLER PARA QUE SE GUARDEN LAS BUSQUEDAS, PUEDA LEER Y MANDARLO AL MAIL
CONFIGURAR LOCALE Y TRADUCIR TODO
MONTAR EL README Y SUBIR AL REPOSITORIO
HACER CHECKS FINALES Y ENTREGAR
    #[Route('/{_locale<en|es>}/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('views/index.html.twig');
    }
}