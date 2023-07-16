<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'allevenement')]
    public function index(EvenementRepository $evenementRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $event = $evenementRepository->findAll();
        $events = new Evenement();

        $form = $this->createForm(EvenementType::class, $events);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($events);
            $manager->flush();

            toastr()->addSuccess('Evènement ajouté');

            return $this->redirectToRoute('allevenement');
        }

        return $this->render('evenement/all.html.twig',[
            'events'=>$event,
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/modifiez-evenement/{id}', name: 'updateevenement')]
    public function updateevenement(Evenement $evenement,EvenementRepository $evenementRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $events = $evenementRepository->find($evenement);

        $form = $this->createForm(EvenementType::class, $events);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($events);
            $manager->flush();

            toastr()->addSuccess('Evènement modifié');

            return $this->redirectToRoute('allevenement');
        }

        return $this->render('evenement/edit.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/deleteevenement/{id}', name: 'deleteevenement')]
    public function deleteevenement(Evenement $evenement,EntityManagerInterface $manager): RedirectResponse
    {

        $manager->remove($evenement);
        $manager->flush();

        toastr()->addSuccess('Evènement supprimé');

        return $this->redirectToRoute('allevenement');
    }

}
