<?php

namespace App\Controller;

use App\Service\FunctionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InsolvableController extends AbstractController
{
    #[Route('/insolvables', name: 'insolvable')]
    public function index(FunctionService $functionService): Response
    {
        $mois = $functionService->mois();
        return $this->render('insolvable/index.html.twig', [
            'mois' => $mois,
        ]);
    }
}
