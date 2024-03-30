<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'allclasse')]
    public function index(ClasseRepository $classeRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $classe = $classeRepository->findAll();
        $classes = new Classe();

        $form = $this->createForm(ClasseType::class, $classes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($classes);
            $manager->flush();

            toastr()->addSuccess('classe ajoutée');

            return $this->redirectToRoute('allclasse');
        }

        return $this->render('classe/all.html.twig', [
            'classes' => $classe,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifiez-classe/{id}', name: 'updateclasse')]
    public function updatematiere(Classe $classe, ClasseRepository $classeRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $classes = $classeRepository->find($classe);

        $form = $this->createForm(ClasseType::class, $classes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($classes);
            $manager->flush();

            toastr()->addSuccess('Classe modifie');

            return $this->redirectToRoute('allclasse');
        }

        return $this->render('classe/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteclasse/{id}', name: 'deleteclasse')]
    public function deleteclasse(Classe $classe, EntityManagerInterface $manager): RedirectResponse
    {

        $manager->remove($classe);
        $manager->flush();

        toastr()->addSuccess('Classe supprimée');

        return $this->redirectToRoute('allclasse');
    }
}
