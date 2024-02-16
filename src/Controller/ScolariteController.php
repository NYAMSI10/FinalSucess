<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Scolarite;
use App\Entity\User;
use App\Form\ScolariteType;
use App\Repository\ClasseRepository;
use App\Repository\HistoriqueRepository;
use App\Repository\PeriodeRepository;
use App\Repository\ScolariteRepository;
use App\Repository\UserRepository;
use App\Service\FunctionService;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScolariteController extends AbstractController
{
    #[Route('/scolarite/{id}', name: 'allscolarite')]
    public function index(User $user, ScolariteRepository $scolariteRepository, ClasseRepository $classeRepository, UserRepository $userRepository): Response
    {
        $nameuser = $userRepository->find($user);
        $scolarite = $scolariteRepository->findBy(['userscolarite' => $user]);
        $montant = $classeRepository->ClasseByStudent($user);

        return $this->render('scolarite/all.html.twig', [
            'scolarites' => $scolarite,
            'montants' => $montant,
            'nameuser' => $nameuser,

        ]);
    }


    #[Route('/addscolairte/{id}', name: 'addscolarite')]
    public function addscolarite( User $user,Request $request, EntityManagerInterface $manager, FunctionService $functionService,
         UserRepository $userRepository, ClasseRepository $classeRepository, ScolariteRepository $scolariteRepository): Response
    {
        $historique = new Historique();
        $scolarite = new Scolarite();
        $annee = date('Y');
        $users = $userRepository->find($user);
        $form = $this->createForm(ScolariteType::class, $scolarite);
        $montant = $classeRepository->ClasseByStudent($user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $mois = $request->get('mois');
            $frais = $request->get('montant');
            $avance = $form->get('avance')->getData();
            $encoderef = $functionService->encoderef();
            $scolarite->setMois($mois);
            $scolarite->setReste($frais - $avance);
            $scolarite->setAvance($avance);
            $scolarite->setUserscolarite($user);
            $scolarite->setRef($encoderef);
            $manager->persist($scolarite);
            $manager->flush();

             $ref =  $scolariteRepository->findOneBy(['ref'=>$encoderef]);
            $historique->setSomme($avance);
            $historique->setMois($mois);
            $historique->setHistscolarite($ref);
            $manager->persist($historique);
            $manager->flush();
            $this->addFlash(
                'success',
                'scolarité ajoutée'
            );

            return $this->redirectToRoute('allscolarite', ['id'=>$users->getId()]);
        }

        $annee = $functionService->mois();
        return $this->render('scolarite/add.html.twig', [
            'form' => $form->createView(),
            'annees' =>$annee,
            'user' =>$users,
            'montants' => $montant,


        ]);
    }




   #[Route('/updatescolairte/{id}', name: 'updatescolarite')]
    public function updatescolarite( Scolarite $scolarite,Request $request, EntityManagerInterface $manager, FunctionService $functionService,
         UserRepository $userRepository, ClasseRepository $classeRepository, ScolariteRepository $scolariteRepository): Response
    {
        $historique = new Historique();
        $scolarite = $scolariteRepository->find($scolarite);
        $form = $this->createForm(ScolariteType::class, $scolarite);
        $montant = $classeRepository->ClasseByStudent($scolarite->getUserscolarite());
        $users = $userRepository->find($scolarite->getUserscolarite());

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $mois = $request->get('mois');
            $encoderef = $request->get('ref');
            $frais = $request->get('montant');
            $avance = $form->get('avance')->getData();
            $scolarite->setMois($mois);
            $scolarite->setReste($frais - $avance);
            $scolarite->setAvance($avance);
            $manager->persist($scolarite);
            $manager->flush();

             $ref =  $scolariteRepository->findOneBy(['ref'=>$encoderef]);

            $historique->setSomme($avance);
            $historique->setMois($mois);
            $historique->setHistscolarite($ref);
            $manager->persist($historique);
            $manager->flush();

            $this->addFlash(
                'success',
                'scolarité modifiée'
            );

            return $this->redirectToRoute('allscolarite', ['id'=>$users->getId()]);
        }

        $annee = $functionService->mois();


        return $this->render('scolarite/edit.html.twig', [
            'form' => $form->createView(),
            'annees' =>$annee,
            'scolarite' =>$scolarite,
            'montants' => $montant,



        ]);
    }


    #[Route('/historique-de-paiement/{id}', name: 'historyscolarite')]
    public function history(Scolarite $scolarite, ScolariteRepository $scolariteRepository, ClasseRepository $classeRepository, UserRepository $userRepository,
                            HistoriqueRepository $historiqueRepository): Response
    {
        $scolarites = $scolariteRepository->find($scolarite);
$histories = $historiqueRepository->findBy(['histscolarite'=>$scolarite]);
        $nameuser = $userRepository->find($scolarites->getUserscolarite());

        return $this->render('scolarite/history.html.twig', [
            'nameuser' => $nameuser,
            'histories' => $histories,


        ]);
    }

    #[Route('/deletescolarite/{id}', name: 'deletescolarite')]
    public function deletescolarite(Scolarite $scolarite, ScolariteRepository $scolariteRepository, ClasseRepository $classeRepository, UserRepository $userRepository,
                            HistoriqueRepository $historiqueRepository,EntityManagerInterface $manager): Response
    {

        $scolarites = $scolariteRepository->find($scolarite);
        $histories = $historiqueRepository->findBy(['histscolarite'=>$scolarite]);
        $nameuser = $userRepository->find($scolarites->getUserscolarite());

        $manager->remove($scolarite);
        $manager->flush();
        toastr()->addSuccess('Paiement supprimé');
        return $this->redirectToRoute('allstudent');
    }

    #[Route('/recuscolarite/{id}', name: 'recuscolarite')]
    public function recuscolarite(Scolarite $scolarite, ScolariteRepository $scolariteRepository, ClasseRepository $classeRepository, UserRepository $userRepository,
                                  HistoriqueRepository $historiqueRepository,PeriodeRepository $periodeRepository): Response
    {

        $scolarites = $scolariteRepository->find($scolarite);
        $histories = $historiqueRepository->findBy(['histscolarite'=>$scolarite]);
        $nameuser = $userRepository->find($scolarites->getUserscolarite());
        $classe = $classeRepository->ClasseByStudent($nameuser->getId());
        $periode = $periodeRepository->PeriodeByTeacher($nameuser->getId());

        $pdfoptions = new Options();

        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->setIsHtml5ParserEnabled(true);
        $pdfoptions->setTempDir('temp');
        $dompdf = new Dompdf();
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('scolarite/recu.html.twig', [
            'classes' => $classe,
            'periodes' => $periode,
            'nameuser' => $nameuser,
            'scolarite' => $scolarites,



        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'recupaiement'. '.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);


        return new Response();

    }

}
