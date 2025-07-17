<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController {

    #[Route('/')]
    public function index() : Response
    {
        return new Response($this->renderView("home/index.html.twig", [
            'title' => 'Home',
            'message' => 'Welcome to the Home Page!'
        ]));
    }
}
