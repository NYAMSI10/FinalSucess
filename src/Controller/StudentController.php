<?php

namespace App\Controller;

use App\Entity\Periode;
use App\Entity\User;
use App\Form\StudentType;
use App\Form\TeacherType;
use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use App\Repository\PeriodeRepository;
use App\Repository\UserRepository;
use App\Service\FunctionService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'allstudent')]
    public function index(PeriodeRepository $periodeRepository, Request $request): Response
    {
        $periode = $periodeRepository->findAll();

        $user = new User();

        $form = $this->createForm(StudentType::class, $user);

        $form->handleRequest($request);

        return $this->render('student/all.html.twig', [
            'periodes' => $periode,
            'form' => $form->createView(),
        ]);
    }




    #[Route('/addstudent', name: 'addstudent')]
    public function addstudent(PeriodeRepository           $periodeRepository,
                               Request                     $request,
                               ManagerRegistry             $doctrine,
                               UserPasswordHasherInterface $hasher,
                               FunctionService             $functionService,
                               UserRepository $userRepository): Response
    {

        $user = new User();

        $form = $this->createForm(StudentType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $manager = $doctrine->getManager();
            $rame = $request->get('rame');
            $periode = $form->get('userperiode')->getData();
            $classe = $form->get('userclasse')->getData();
            $name= $form->get('firstname')->getData();

            $mail = $userRepository->findBy(['email' => $name.'@groupesucess.com']);

            if ($mail) {
                toastr()->addError('Désolé cet email existe déja ');
                return $this->render('student/add.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            // encode the plain password
            $hashedPassword = $hasher->hashPassword(
                $user,
                $functionService->encodepassword());

            if (!$periode || !$classe) {
                toastr()->addError('le champs periode ou classe  est obligatoire ');
                return $this->render('teacher/add.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
            if ($rame == 0) {
                $user->setIsRame(false);
            } else {

                $user->setIsRame(true);

            }
            $user->setRoles(['ROLE_STUDENT']);

            $user->setPassword($hashedPassword);
            $user->setMatricule($functionService->encodematricule());
            $user->setIsTeacher(false);
            $user->setAnnee($functionService->annee());
            $user->setEmail($name.'@groupesucess.com');
            $user->addUserperiode($periode);
            $user->addUserclasse($classe);




            $manager->persist($user);
            $manager->flush();

            toastr()->addSuccess('Elève ajouté');
            return $this->redirectToRoute('allstudent');
        }

        return $this->render('student/add.html.twig', [
            'form' => $form->createView(),

        ]);
    }




    #[Route('/student/{id}', name: 'showstudent')]
    public function allstudent(Periode $periode,PeriodeRepository $periodeRepository, UserRepository $userRepository): Response
    {
        $periodes = $periodeRepository->find($periode);
        //$users = $userRepository->findBy(['IsTeacher'=>true]);
        $users = $userRepository->StudentByPeriode($periode);

        return $this->render('student/allstudent.html.twig', [
            'periodes' => $periodes,
            'users' => $users,

        ]);
    }

}
