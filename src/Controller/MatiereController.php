<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class MatiereController extends AbstractController
{
    #[Route('/matiere', name: 'allmatiere')]
    public function index(MatiereRepository $matiereRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $matiere = $matiereRepository->findAll();
        $matieres = new Matiere();

        $form = $this->createForm(MatiereType::class, $matieres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($matieres);
            $manager->flush();

            toastr()->addSuccess('Matiére ajoutée');

            return $this->redirectToRoute('allmatiere');
        }

        return $this->render('matiere/all.html.twig', [
            'matieres' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifiez-matiere/{id}', name: 'updatematiere')]
    public function updatematiere(Matiere $matiere, MatiereRepository $matiereRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $matiere = $matiereRepository->find($matiere);

        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($matiere);
            $manager->flush();

            toastr()->addSuccess('Matiére modifie');

            return $this->redirectToRoute('allmatiere');
        }

        return $this->render('matiere/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deletematiere/{id}', name: 'deletematiere')]
    public function deletematiere(Matiere $matiere, EntityManagerInterface $manager): Response
    {

        $manager->remove($matiere);
        $manager->flush();

        toastr()->addSuccess('Matiére supprimée');

        return $this->redirectToRoute('allmatiere');
    }
}
