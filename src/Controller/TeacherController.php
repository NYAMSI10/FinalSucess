<?php

namespace App\Controller;

use App\Entity\Periode;
use App\Entity\User;
use App\Form\TeacherType;
use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use App\Repository\PeriodeRepository;
use App\Repository\UserRepository;
use App\Service\FunctionService;
use App\Service\ShowUser;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'allteacher')]
    public function index(PeriodeRepository $periodeRepository, Request $request): Response
    {
        $periode = $periodeRepository->findAll();

        $user = new User();

        $form = $this->createForm(TeacherType::class, $user);

        $form->handleRequest($request);

        return $this->render('teacher/all.html.twig', [
            'periodes' => $periode,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/addteacher', name: 'addteacher')]
    public function addteacher(PeriodeRepository           $periodeRepository,
                               Request                     $request,
                               ManagerRegistry             $doctrine,
                               UserPasswordHasherInterface $hasher,
                               FunctionService             $functionService,
                               ClasseRepository            $classeRepository,
                               MatiereRepository           $matiereRepository,
                               UserRepository              $userRepository): Response
    {

        $user = new User();

        $form = $this->createForm(TeacherType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $manager = $doctrine->getManager();
            $role = $request->get('role');
            $periode = $form->get('userperiode')->getData();
            $classe = $form->get('userclasse')->getData();
            $matiere = $form->get('usermatiere')->getData();

            $mail = $userRepository->findBy(['email' => $form->get('email')->getData()]);

            if ($mail) {
                toastr()->addError('Désolé cet email existe déja ');
                return $this->render('teacher/add.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            // encode the plain password
            $hashedPassword = $hasher->hashPassword(
                $user,
                $functionService->encodepassword());

            if (!$periode || !$classe || !$matiere) {
                toastr()->addError('le champs periode ou classe ou matiére est obligatoire ');
                return $this->render('teacher/add.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
            if ($role == 0) {
                $user->setRoles(['ROLE_TEACHER']);
            } else {

                $user->setRoles(['ROLE_ADMIN']);

            }

            $user->setPassword($hashedPassword);
            $user->setMatricule($functionService->encodematricule());
            $user->setIsTeacher(true);

            foreach ($periode as $value) {
                $periodeid = $periodeRepository->find($value);

                $user->addUserperiode($periodeid);

            }
            foreach ($matiere as $value) {
                $matiereid = $matiereRepository->find($value);

                $user->addUsermatiere($matiereid);

            }
            foreach ($classe as $value) {
                $classeid = $classeRepository->find($value);
                $user->addUserclasse($classeid);

            }


            $manager->persist($user);
            $manager->flush();

            toastr()->addSuccess('Enseignant ajouté');
            return $this->redirectToRoute('allteacher');
        }

        return $this->render('teacher/add.html.twig', [
            'form' => $form->createView(),

        ]);
    }


    #[Route('/teacher/{id}', name: 'showteacher')]
    public function allteacher(Periode $periode, PeriodeRepository $periodeRepository, UserRepository $userRepository): Response
    {
        $periodes = $periodeRepository->find($periode);
        //$users = $userRepository->findBy(['IsTeacher'=>true]);
        $users = $userRepository->TeacherByPeriode($periode);

        return $this->render('teacher/allteacher.html.twig', [
            'periodes' => $periodes,
            'users' => $users,

        ]);
    }


    #[Route('/modifiez-teacher/{id}', name: 'updateteacher')]
    public function updateteacher(User              $user,
                                  UserRepository    $userRepository,
                                  PeriodeRepository $periodeRepository,
                                  Request           $request,
                                  ManagerRegistry   $doctrine,
                                  ShowUser          $showUser,
                                  ClasseRepository  $classeRepository,
                                  MatiereRepository $matiereRepository): Response
    {

        $periodes = $periodeRepository->PeriodeByTeacher($user);

        $users = $userRepository->find($user);


        $form = $this->createForm(TeacherType::class, $users);
        $form->handleRequest($request);




        if ($form->isSubmitted()) {

            $manager = $doctrine->getManager();
            $role = $request->get('role');
            $periode = $form->get('userperiode')->getData();
            $classe = $form->get('userclasse')->getData();
            $matiere = $form->get('usermatiere')->getData();


            if (!$periode || !$classe || !$matiere) {
                toastr()->addError('le champs periode ou classe ou matiére est obligatoire ');
                return $this->render('teacher/add.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
            if ($role == 0) {
                $users->setRoles(['ROLE_TEACHER']);
            } else {

                $users->setRoles(['ROLE_ADMIN']);

            }


            foreach ($periode as $value) {

                $periodeid = $periodeRepository->find($value);

                $users->addUserperiode($periodeid);

            }
            foreach ($matiere as $value) {
                $matiereid = $matiereRepository->find($value);

                $users->addUsermatiere($matiereid);

            }
            foreach ($classe as $value) {
                $classeid = $classeRepository->find($value);
                $users->addUserclasse($classeid);

            }


            $manager->persist($users);
            $manager->flush();

            //  toastr()->addSuccess('Enseignant modifié');
            // return $this->redirectToRoute('allteacher');
        }
        $form->remove('userperiode');
        $form->remove('usermatiere');
        $form->remove('userclasse');

        return $this->render('teacher/edit.html.twig', [
            'form' => $form->createView(),
            'periodes' => $periodes,
            'user' => $users,
            'classes'=>$showUser->classeRestant($users),
            'matieres'=>$showUser->matiereRestant($users),
            'perios'=>$showUser->periodeRestant($users)
        ]);
    }


    #[Route('delete/{id}', name: 'deleteteacher')]
    public function deleteteacher(User $user, ManagerRegistry $doctrine): Response
    {


        $em = $doctrine->getManager();
        $em->remove($user);
        $em->flush();
        //     $this->addFlash('success', "L'annone a été suprimer avec succes");

        toastr()->addSuccess('Enseignant supprimé');
        return $this->redirectToRoute('allteacher');
    }

}
