<?php

namespace App\Controller;

use App\Repository\ScolariteRepository;
use App\Service\FunctionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InsolvableController extends AbstractController
{
    #[Route('/insolvables', name: 'insolvable')]
    public function index(FunctionService $functionService, ScolariteRepository $scolariteRepository): Response
    {
        $moispaie = $scolariteRepository->moisPaie();
        return $this->render('insolvable/index.html.twig', [
            'mois' => $moispaie,
        ]);
    }
    #[Route('/liste-des-insolvables/', name: 'allinsolvable')]
    public function allinsolvables(Request $request,FunctionService $functionService, ScolariteRepository $scolariteRepository): Response
    {        $mois = $request->get('mois');

        $insol= $scolariteRepository->findBy(['mois'=>$mois]);
        $moispaie = $scolariteRepository->moisPaie();
        return $this->render('insolvable/insol.html.twig', [
            'insols' => $insol,
            'moispaie' => $moispaie,
            'mois' => $mois
        ]);
    }
}
