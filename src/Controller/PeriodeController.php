<?php

namespace App\Controller;

use App\Entity\Periode;
use App\Form\PeriodeType;
use App\Repository\PeriodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeriodeController extends AbstractController
{
    #[Route('/periode', name: 'allperiode')]
    public function index(PeriodeRepository $periodeRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $periode = $periodeRepository->findAll();
        $periodes = new Periode();

        $form = $this->createForm(PeriodeType::class, $periodes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
             $manager->persist($periodes);
             $manager->flush();


            $this->addFlash(
                'success',
                'période modifie'
            );
             return $this->redirectToRoute('allperiode');
        }

        return $this->render('periode/all.html.twig',[
            'periodes'=>$periode,
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/modifiez-periode/{id}', name: 'updateperiode')]
    public function updateperiode(Periode $periode,PeriodeRepository $periodeRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $periode = $periodeRepository->find($periode);

        $form = $this->createForm(PeriodeType::class, $periode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($periode);
            $manager->flush();

            $this->addFlash(
                'success',
                'période modifié'
            );
            return $this->redirectToRoute('allperiode');
        }

        return $this->render('periode/edit.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    #[Route('deleteperiode/{id}', name: 'deleteperiode')]
    public function deleteperiode(Periode $periode,EntityManagerInterface $manager): JsonResponse
    {

        $manager->remove($periode);
        $manager->flush();

        return new JsonResponse();
    }


}
