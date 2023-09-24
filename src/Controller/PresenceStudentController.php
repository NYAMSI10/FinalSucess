<?php

namespace App\Controller;

use App\Entity\PresenceStudent;
use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use App\Repository\PeriodeRepository;
use App\Repository\PresenceStudentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class PresenceStudentController extends AbstractController
{
    #[Route('/presence/student', name: 'presenceperiode')]
    public function index(PeriodeRepository $periodeRepository): Response
    {
        $periode = $periodeRepository->PeriodeByTeacher($this->getUser());

        return $this->render('presencestudent/allperiode.html.twig', [
            'periodes' => $periode,
        ]);
    }

    #[Route('/presence/classe/{id}', name: 'presenceclasse')]
    public function presenceclasse($id, ClasseRepository $classeRepository): Response
    {
        $classe = $classeRepository->ClasseByStudent($this->getUser());




        return $this->render('presencestudent/allclasse.html.twig', [
            'classes' => $classe,
            'idperiode' => $id,
        ]);
    }

    #[Route('/presence/student/periode?={idperiode}/classe?={idclasse}', name: 'presenceuser')]
    public function presenceuser($idperiode, $idclasse, UserRepository $userRepository, MatiereRepository $matiereRepository, ClasseRepository $classeRepository, PresenceStudentRepository $presenceStudentRepository): Response
    {
        $nameclasse = $classeRepository->find($idclasse);

        $userperiode = $userRepository->StudentByPeriode($idperiode);
        $userclasse = $userRepository->StudentByClasse($idclasse);

        $matiereuser = $matiereRepository->MatiereByTeacher($this->getUser());

        $user = $presenceStudentRepository->findBy(['datejours'=>date('Y-m-d'), 'userpresence'=>$this->getUser(), 'periodepresence'=>$idperiode , 'classepresence'=>$idclasse]);

        if ($user)
        {
            toastr()->addError('Vous avez déjà fait l\'appel dans cette classe pour cette période');
            return $this->redirectToRoute('presenceclasse',['id'=>$idperiode]);

        }else{
            return $this->render('presencestudent/allstudent.html.twig', [
                'userperiodes' => $userperiode,
                'userclasses' => $userclasse,
                'matiereusers' => $matiereuser,
                'nameclasse' => $nameclasse,
                'id'=>$idperiode,
                'idclas'=>$idclasse,
            ]);
        }

    }

    #[Route('/addabscence/student', name: 'addabscence')]
    public function addabscence(Request $request,PeriodeRepository $periodeRepository ,UserRepository $userRepository, MatiereRepository $matiereRepository, ClasseRepository $classeRepository,EntityManagerInterface $em): RedirectResponse
    {
        $matiere = $request->get('matiere');
        $start = $request->get('start');;
        $end = $request->get('end');
        $idstudents = $request->get('student');
        $idperiode = $request->get('idperiode');
        $idclasse = $request->get('idclasse');
        $datejours = date_format(new \DateTime(), 'Y-m-d');


        $absence = new PresenceStudent();

        foreach ($idstudents as $value) {
            $id = $userRepository->find($value);
            $absence->addStudent($id);
        }

        $idmatiere = $matiereRepository->find($matiere);
        $id= $periodeRepository->find($idperiode);
        $idclas= $classeRepository->find($idclasse);

        $absence->setMatierepresence($idmatiere);
        $absence->setHourstart($start);
        $absence->setHoursend($end);
        $absence->setPeriodepresence($id);
        $absence->setClassepresence($idclas);
        $absence->setDatejours($datejours);
        $absence->setUserpresence($this->getUser());

        $em->persist($absence);
        $em->flush();

        toastr()->addSuccess('Appel effectué');
        return $this->redirectToRoute('presenceperiode');
    }

}
