<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ClasseRepository;
use App\Repository\SalaireRepository;
use App\Repository\ScolariteRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_TEACHER')")
 */
class BulletinPaieController extends AbstractController
{
    #[Route('/bulletin-paie', name: 'allbulletinpaie')]
    public function index(SalaireRepository $salaireRepository): Response
    {

        $salaire = $salaireRepository->findBy(['usersalaire' => $this->getUser()]);


        return $this->render('bulletin_paie/all.html.twig', [

            'salaires' => $salaire,

        ]);
    }

    #[Route('/recu-paiement', name: 'myrecu')]
    public function myrecu(ScolariteRepository $scolariteRepository, ClasseRepository $classeRepository, UserRepository $userRepository): Response
    {
        $scolarite = $scolariteRepository->findBy(['userscolarite' => $this->getUser()]);
        $classe = $classeRepository->ClasseByStudent($this->getUser());

        return $this->render('scolarite/myscolarite.html.twig', [
            'scolarites' => $scolarite,
            'classes' => $classe,

        ]);
    }
}
