<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: '/')]
    public function index(): Response
    {
        return $this->render('ComponentAccueil/main.html.twig');
    }

    #[Route('Dashboard', name:'Dashboard')]

public function dashboard(): Response
    {
        return $this->render('ComponentDashbord/home.html.twig');
    }
}
