<?php

namespace App\Controller;

use App\Entity\Prime;
use App\Form\PrimeType;
use App\Repository\PrimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrimeController extends AbstractController
{
    #[Route('/prime', name: 'allprime')]
    public function index(PrimeRepository $primeRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $prime = $primeRepository->findAll();
        $primes = new Prime();

        $form = $this->createForm(PrimeType::class, $primes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($primes);
            $manager->flush();


            $this->addFlash(
                'success',
                'prime ajoutée'
            );
            return $this->redirectToRoute('allprime');
        }

        return $this->render('prime/all.html.twig',[
            'primes'=>$prime,
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/modifiez-prime/{id}', name: 'updateprime')]
    public function updateprime(Prime $prime,PrimeRepository $primeRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $primes = $primeRepository->find($prime);

        $form = $this->createForm(PrimeType::class, $primes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($primes);
            $manager->flush();


            $this->addFlash(
                'success',
                'prime modifiée'
            );
            return $this->redirectToRoute('allprime');
        }

        return $this->render('prime/edit.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/deleteprime/{id}', name: 'deleteprime')]
    public function deleteprime(Prime $prime,EntityManagerInterface $manager): RedirectResponse|JsonResponse
    {

        $manager->remove($prime);
        $manager->flush();


        return new JsonResponse();
    }

}
