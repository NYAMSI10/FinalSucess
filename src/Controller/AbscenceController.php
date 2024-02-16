<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use App\Repository\PeriodeRepository;
use App\Repository\PresenceStudentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbscenceController extends AbstractController
{
    #[Route('/Abscence/student', name: 'abscenceperiode')]
    public function index(PeriodeRepository $periodeRepository): Response
    {
        $periode = $periodeRepository->findAll();

        return $this->render('abscence/allperiode.html.twig', [
            'periodes' => $periode,
        ]);
    }

    #[Route('/abscence/classe/{id}', name: 'abscenceclasse')]
    public function abscenceclasse($id, ClasseRepository $classeRepository, PresenceStudentRepository $presenceStudentRepository): Response
    {
        $classe = $classeRepository->findAll();
        $abscencedate = $presenceStudentRepository->date();


        return $this->render('abscence/allclasse.html.twig', [
            'classes' => $classe,
            'idperiode' => $id,
            'abscencedates' => $abscencedate,

        ]);
    }

    #[Route('/abscence/allstudent', name: 'abscenceallstudent')]
    public function abscenceallstudent(PresenceStudentRepository $presenceStudentRepository, Request $request): Response
    {
        $dates = $request->get('date');


        $allabsent = $presenceStudentRepository->findBy(['datejours' => $dates]);
        $abscencedate = $presenceStudentRepository->date();


        return $this->render('abscence/filtreabsent.html.twig', [

            'abscencedates' => $abscencedate,
            'allabsents' => $allabsent,
            'date' => $dates

        ]);
    }

    #[Route('/abscence/date/periode?={idperiode}/classe?={idclasse}', name: 'abscencedate')]
    public function abscencedate($idperiode, $idclasse, ClasseRepository $classeRepository,
                                 PeriodeRepository $periodeRepository, PresenceStudentRepository $presenceStudentRepository): Response
    {
        $idclas = $classeRepository->find($idclasse);
        $idperio = $periodeRepository->find($idperiode);

        $abscencedate = $presenceStudentRepository->abscenceByDate($idclas->getId(), $idperio->getId());


        return $this->render('abscence/alldate.html.twig', [
            'abscencedates' => $abscencedate,
            'idperiode' => $idperiode,
            'idclasse' => $idclasse
        ]);
    }

    #[Route('/abscence/student/periode?={idperiode}/classe?={idclasse}/jours?={createdAt}', name: 'abscenceuser')]
    public function abscenceuser($idperiode, $idclasse, $createdAt, ClasseRepository $classeRepository, MatiereRepository $matiereRepository,
                                 PeriodeRepository $periodeRepository, PresenceStudentRepository $presenceStudentRepository,UserRepository $userRepository): Response
    {

        $absencestudent = $presenceStudentRepository->findOneBy(['datejours' => $createdAt, 'periodepresence' => $idperiode, 'classepresence' => $idclasse]);

        $nameclasse = $classeRepository->find($idclasse);
        $a = $userRepository->studentBypresence($absencestudent->getId());
        $b = $userRepository->studentByperioclasse($absencestudent->getPeriodepresence()->getId(),$absencestudent->getClassepresence()->getId());




        return $this->render('abscence/allstudent.html.twig', [
            'absencestudents' => array_diff($b,$a),
            'nameclasse' => $nameclasse,
            'absent'=>$absencestudent
        ]);
    }
}
