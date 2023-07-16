<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Scolarite;
use App\Entity\User;
use App\Form\ScolariteType;
use App\Repository\ClasseRepository;
use App\Repository\ScolariteRepository;
use App\Repository\UserRepository;
use App\Service\FunctionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScolariteController extends AbstractController
{
    #[Route('/scolarite/{id}', name: 'allscolarite')]
    public function index(User $user, ScolariteRepository $scolariteRepository, ClasseRepository $classeRepository, UserRepository $userRepository): Response
    {
        $nameuser = $userRepository->find($user);
        $scolarite = $scolariteRepository->findBy(['userscolarite' => $user]);
        $montant = $classeRepository->ClasseByStudent($user);

        return $this->render('scolarite/all.html.twig', [
            'scolarites' => $scolarite,
            'montants' => $montant,
            'nameuser' => $nameuser,

        ]);
    }


    #[Route('/addscolairte/{id}', name: 'addscolarite')]
    public function addscolarite( User $user,Request $request, EntityManagerInterface $manager, FunctionService $functionService,
         UserRepository $userRepository, ClasseRepository $classeRepository, ScolariteRepository $scolariteRepository): Response
    {
        $historique = new Historique();
        $scolarite = new Scolarite();
        $annee = date('Y');
        $users = $userRepository->find($user);
        $form = $this->createForm(ScolariteType::class, $scolarite);
        $montant = $classeRepository->ClasseByStudent($user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $mois = $request->get('mois');
            $frais = $request->get('montant');
            $avance = $form->get('avance')->getData();
            $encoderef = $functionService->encoderef();
            $scolarite->setMois($mois);
            $scolarite->setReste($frais - $avance);
            $scolarite->setAvance($avance);
            $scolarite->setUserscolarite($user);
            $scolarite->setRef($encoderef);
            $manager->persist($scolarite);
            $manager->flush();

             $ref =  $scolariteRepository->findOneBy(['ref'=>$encoderef]);
            $historique->setSomme($avance);
            $historique->setMois($mois);
            $historique->setHistscolarite($ref);
            $manager->persist($historique);
            $manager->flush();
            toastr()->addSuccess('Paiement ajouté');
            return $this->redirectToRoute('allscolarite', ['id'=>$users->getId()]);
        }

        return $this->render('scolarite/add.html.twig', [
            'form' => $form->createView(),
            'annee' =>$annee,
            'user' =>$users,
            'montants' => $montant,


        ]);
    }


}
