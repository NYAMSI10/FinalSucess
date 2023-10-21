<?php

namespace App\Controller;

use App\Entity\PresenceStudent;
use App\Repository\PresenceStudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresenceTeacherController extends AbstractController
{
    #[Route('/validation-presence/teacher', name: 'validationteacher')]
    public function index(PresenceStudentRepository $presenceStudentRepository): Response
    {
        $user = $presenceStudentRepository->findBy(['IsAccept' => null]);


        return $this->render('presenceteacher/index.html.twig', [

            'users' => $user
        ]);
    }

    #[Route('validation-presence/acceptteacher/{id}', name: 'acceptteacher')]
    public function accept(PresenceStudent $presenceStudent, PresenceStudentRepository $presenceStudentRepository, EntityManagerInterface $em): JsonResponse
    {
        $user = $presenceStudentRepository->find($presenceStudent);

        $user->setIsAccept(true);
        $em->persist($user);
        $em->flush();

        return new JsonResponse();
    }

    #[Route('validation-presence/refuseteacher/{id}', name: 'refuseteacher')]
    public function refuse(PresenceStudent $presenceStudent, PresenceStudentRepository $presenceStudentRepository, EntityManagerInterface $em): JsonResponse
    {

        $user = $presenceStudentRepository->find($presenceStudent);

        $user->setIsAccept(false);
        $em->persist($user);
        $em->flush();

        return new JsonResponse();
    }

    #[Route('/absence/teacher', name: 'absenceteacher')]
    public function absent(PresenceStudentRepository $presenceStudentRepository): Response
    {
        $user = $presenceStudentRepository->findBy(['IsAccept' => 0]);

      /*  $a = new \DateTime($user->getHourstart());
        $b = new \DateTime($user->getHoursend());

        // Calcul de la différence d'heure
        $timeDifference = $a->diff($b);

        dd($timeDifference->h);*/

        return $this->render('presenceteacher/listeabsent.html.twig', [

            'users' => $user
        ]);
    }

    #[Route('/vos-absence', name: 'vosabsence')]
    public function vosabsence(PresenceStudentRepository $presenceStudentRepository): Response
    {
        $user = $presenceStudentRepository->findBy(['IsAccept' => 0, 'userpresence'=>$this->getUser()]);

        return $this->render('presenceteacher/absence.html.twig', [

            'users' => $user
        ]);
    }

}
