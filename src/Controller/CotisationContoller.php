<?php

namespace App\Controller;

use App\Entity\Cotisation;
use App\Form\CotisationType;
use App\Repository\CotisationRepository;
use App\Repository\UserRepository;
use App\Service\FunctionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CotisationContoller extends AbstractController
{
    #[Route('/cotisation', name: 'allcotisation')]
    public function index(CotisationRepository $cotisationRepository): Response
    {
        $cotisation = $cotisationRepository->findAll();

        return $this->render('cotisation/all.html.twig', [

            "cotisations" => $cotisation,
        ]);
    }

    #[Route('/addcotisation', name: 'addcotisation')]
    public function addcotisation(Request $request, FunctionService $functionService, EntityManagerInterface $em,
         CotisationRepository $cotisationRepository): Response
    {
        $cotisation = new Cotisation();

        $form = $this->createForm(CotisationType::class, $cotisation);
        $form->handleRequest($request);

        $annee = $functionService->mois();


        if ($form->isSubmitted() && $form->isValid()) {

            $mois = $request->get('mois');
            $iduser = $form->get('usercotisation')->getData();
            $somme = $form->get('somme')->getData();
            $existecotisation = $cotisationRepository->findBy(['moisbouffe'=>$mois, 'somme'=>$somme]);
            if ($existecotisation)
            {
                toastr()->addError('Un enseignant bouffe déjà à ce mois et avec ce montant');
                return $this->redirectToRoute('addcotisation');
            }
            $cotisation->setMoisbouffe($mois);
            $cotisation->setUsercotisation($iduser);
            $em->persist($cotisation);
            $em->flush();

            toastr()->addSuccess('Cotisation ajoutée');

            return $this->redirectToRoute('allcotisation');

        }


        return $this->render('cotisation/add.html.twig', [

            'form' => $form->createView(),
            'annees' => $annee,
        ]);
    }

    #[Route('/updatecotisation/{id}', name: 'updatecotisation')]
    public function updatecotisation(Cotisation     $cotisation, Request $request, FunctionService $functionService, EntityManagerInterface $em, CotisationRepository $cotisationRepository,
                                     UserRepository $userRepository): Response
    {
        $cotisations = $cotisationRepository->find($cotisation);
        $form = $this->createForm(CotisationType::class, $cotisations);
        $form->handleRequest($request);

        $allteacher = $userRepository->findBy(['IsTeacher' => 1]);

        $annee = $functionService->annees();


        if ($form->isSubmitted() && $form->isValid()) {
            $mois = $request->get('mois');
            $iduser = $request->get('enseignant');
            $somme = $form->get('somme')->getData();
          /*  $existecotisation = $cotisationRepository->findBy(['moisbouffe'=>$mois, 'somme'=>$somme]);
            if ($cotisations->getMoisbouffe())
            {
                toastr()->addError('Un enseignant bouffe déjà à ce mois et avec ce montant');
                return $this->redirectToRoute('addcotisation');
            }*/
            $id = $userRepository->find($iduser);
            $cotisations->setMoisbouffe($mois);
            $cotisations->setUsercotisation($id);
            $em->persist($cotisations);
            $em->flush();

            toastr()->addSuccess('Cotisation modifiée');

            return $this->redirectToRoute('allcotisation');

        } else {
            $form->remove('usercotisation');
            return $this->render('cotisation/edit.html.twig', [

                'form' => $form->createView(),
                'annees' => $annee,
                'cotisations' => $cotisations,
                'allteacher' => $allteacher,
            ]);
        }


    }

    #[Route('/deletecotisation/{id}', name: 'deletecotisation')]
    public function deletecotisation(Cotisation  $cotisation,EntityManagerInterface $manager): RedirectResponse
    {

        $manager->remove($cotisation);
        $manager->flush();

        toastr()->addSuccess('Cotisation supprimée');

        return $this->redirectToRoute('allcotisation');
    }


}
