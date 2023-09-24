<?php

namespace App\Controller;

use App\Entity\Classe;
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
use Symfony\Component\HttpFoundation\JsonResponse;
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



        return $this->render('student/all.html.twig', [
            'periodes' => $periode,
        ]);
    }

    #[Route('/student/classe/{id}', name: 'studentclasse')]
    public function presenceclasse($id, ClasseRepository $classeRepository): Response
    {
        $classe = $classeRepository->findAll();


        return $this->render('student/allclasse.html.twig', [
            'classes' => $classe,
            'idperiode' => $id,
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
;            $nom = explode(" ", $name);
            if (count($nom) >= 2) {
                $nomConcatene = $nom[0] . "" . $nom[1]; // Concaténation des deux premiers noms

            }
            $user->setRoles(['ROLE_STUDENT']);

            $user->setPassword($hashedPassword);
            $user->setMatricule($functionService->encodematricule());
            $user->setIsTeacher(false);
            $user->setAnnee($functionService->annee());
            $user->setEmail($nomConcatene.'@groupesucess.com');
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


    #[Route('/modifiez-student/{id}', name: 'updatestudent')]
    public function updatestudent(
         User $users ,PeriodeRepository           $periodeRepository,
                                  Request                     $request,
                                  ManagerRegistry             $doctrine,
                                  UserPasswordHasherInterface $hasher,
                                  FunctionService             $functionService,
                                  UserRepository $userRepository): Response
    {

        $user =$userRepository->find($users);

        $form = $this->createForm(StudentType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $manager = $doctrine->getManager();
            $rame = $request->get('rame');
            $periode = $form->get('userperiode')->getData();
            $classe = $form->get('userclasse')->getData();
            $name= $form->get('firstname')->getData();



            // encode the plain password
            $hashedPassword = $hasher->hashPassword(
                $user,
                $functionService->encodepassword());


            if ($rame == 0) {
                $user->setIsRame(false);
            } else {

                $user->setIsRame(true);

            }

            $user->setAnnee($functionService->annee());
            $user->addUserperiode($periode);
            $user->addUserclasse($classe);

            $manager->persist($user);
            $manager->flush();

            toastr()->addSuccess('Elève modifié');
            return $this->redirectToRoute('allstudent');
        }

        return $this->render('student/edit.html.twig', [
            'form' => $form->createView(),
            'user'=> $user

        ]);
    }


    #[Route('/student/periode?={periode}/classe?={classe}', name: 'showstudent')]
    public function allstudent(Periode $periode,Classe $classe,PeriodeRepository $periodeRepository, UserRepository $userRepository,ClasseRepository $classeRepository): Response
    {
        $nameclasse = $classeRepository->find($classe);
        $periode = $periodeRepository->find($periode);

        $userperiode = $userRepository->StudentByPeriode($periode);
        $userclasse = $userRepository->StudentByClasse($classe);

        return $this->render('student/allstudent.html.twig', [
            'userperiodes' => $userperiode,
            'userclasses' => $userclasse,
            'nameclasse' => $nameclasse,
            'periode' => $periode,


        ]);
    }

    #[Route('student/deletestudent/{id}', name: 'deletestudent')]
    public function deletestudent(User $user, ManagerRegistry $doctrine): JsonResponse
    {


        $em = $doctrine->getManager();
        $em->remove($user);
        $em->flush();
        //     $this->addFlash('success', "L'annone a été suprimer avec succes");


        return new JsonResponse();
    }


}
