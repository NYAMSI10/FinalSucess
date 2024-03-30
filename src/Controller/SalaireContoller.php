<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EvenementObtenu;
use App\Entity\PrimeObtenu;
use App\Entity\Salaire;
use App\Entity\User;
use App\Repository\ClasseRepository;
use App\Repository\CotisationRepository;
use App\Repository\EvenementObtenuRepository;
use App\Repository\EvenementRepository;
use App\Repository\PeriodeRepository;
use App\Repository\PresenceStudentRepository;
use App\Repository\PrimeObtenuRepository;
use App\Repository\PrimeRepository;
use App\Repository\SalaireRepository;
use App\Repository\ScolariteRepository;
use App\Repository\UserRepository;
use App\Service\FunctionService;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class SalaireContoller extends AbstractController
{
    #[Route('/salaire/{id}', name: 'allsalaire')]
    public function index(User $user, UserRepository $userRepository, SalaireRepository $salaireRepository): Response
    {
        $nameuser = $userRepository->find($user);

        $salaire = $salaireRepository->findBy(['usersalaire' => $nameuser->getId()]);


        return $this->render('salaire/all.html.twig', [

            'nameuser' => $nameuser,
            'salaires' => $salaire,

        ]);
    }

    #[Route('/salaire/formulaire/{id}', name: 'formsalaire')]
    public function formulairesalaire(
        User                 $user,
        UserRepository $userRepository,
        PrimeRepository $primeRepository,
        EvenementRepository  $evenementRepository,
        FunctionService $functionService,
        CotisationRepository $cotisationRepository,
        PeriodeRepository $periodeRepository,
        PresenceStudentRepository $presenceStudentRepository
    ): Response {
        $nameuser = $userRepository->find($user);
        $prime = $primeRepository->findAll();
        $even = $evenementRepository->findAll();
        $datetoday = date('Y-m-d');
        $annee = $functionService->annees();
        $existcotisation = $cotisationRepository->findBy(['usercotisation' => $user]);

        if ($existcotisation) {
            $cotisation = $cotisationRepository->CotisationByTeacher($user);
        } else {
            $cotisation = 0;
        }

        $users = $presenceStudentRepository->findBy(['IsAccept' => 1, 'userpresence' => $user]);


        $totalHours = 0;
        $Minutes = 0;

        foreach ($users as $value) {
            $a = new \DateTime($value->getHourstart());
            $b = new \DateTime($value->getHoursend());

            // Calcul de la différence d'heure
            $interval = $b->diff($a);
            $totalHours += $interval->h; // Ajoutez les heures de l'intervalle.
            $Minutes += $interval->i; // Ajoute les minutes

        }
        $totalMinutes = ($totalHours * 60) + $Minutes;

        $periode = $periodeRepository->PeriodeByTeacher($user);

        return $this->render('salaire/add.html.twig', [

            'nameuser' => $nameuser,
            'primes' => $prime,
            'evens' => $even,
            'datetoday' => $datetoday,
            'annees' => $annee,
            'cotisation' => $cotisation,
            'periodes' => $periode,
            'totalMinutes' => $totalMinutes

        ]);
    }


    #[Route('/salaire/validation/{id}', name: 'addsalaire')]
    public function addsalaire(
        User                 $user,
        UserRepository $userRepository,
        PrimeRepository $primeRepository,
        EvenementRepository  $evenementRepository,
        FunctionService $functionService,
        CotisationRepository $cotisationRepository,
        Request $request,
        EntityManagerInterface $manager,
        PeriodeRepository    $periodeRepository,
        SalaireRepository $salaireRepository
    ): Response {
        $periode = $request->get('periode');
        $mois = $request->get('mois');
        $nbrework = $request->get('nbrework');
        $mtfrais = $request->get('mtfrais');
        $mttotal = (($nbrework * $mtfrais) / 60);
        $amicale = $request->get('amicale');
        $cotisation = $request->get('cotisation');
        $benefcotistion = $request->get('benefcotistion');
        $prime = $request->get('prime');
        $events = $request->get('events');
        $nameevents = $request->get('nameevents');
        $eventsvolontaire = $request->get('eventsvolontaire');
        $nameeventsvolontaire = $request->get('nameeventsvolontaire');
        $ref = $functionService->encoderef();
        $idperiode = $periodeRepository->find($periode);
        $users = $userRepository->find($user);
        $s1 = 0;
        $s2 = 0;
        $p = 0;


        $salaire = new Salaire();
        $existe = $salaireRepository->findBy(['usersalaire' => $users->getId(), 'mois' => $mois, 'periodesalaire' => $periode]);

        if ($existe) {
            toastr()->addError('Ce Paiement existe déjà!');
            return $this->redirectToRoute('formsalaire', ['id' => $users->getId()]);
        }


        $salaire->setPeriodesalaire($idperiode);
        $salaire->setUsersalaire($user);
        $salaire->setMois($mois);
        $salaire->setNbretravail($nbrework);
        $salaire->setMontantfrais($mtfrais);
        $salaire->setMontantsalaire(0);
        $salaire->setAmical($amicale);
        $salaire->setCotisation($cotisation);
        $salaire->setBenefcotisation($benefcotistion);
        $salaire->setRef($ref);

        $manager->persist($salaire);
        $manager->flush();

        $idsalaire = $salaireRepository->findOneBy(['ref' => $ref]);
        if ($prime) {
            foreach ($prime as $value) {
                $primeobtenu = new PrimeObtenu();

                $primeinfo = $primeRepository->find($value);

                $p = $p + $primeinfo->getSomme();

                $primeobtenu->setName($primeinfo->getName());
                $primeobtenu->setSomme($primeinfo->getSomme());
                $primeobtenu->setSalaireprimeobtenu($idsalaire);
                $manager->persist($primeobtenu);
                $manager->flush();
            }
        }

        if ($nameevents) {
            foreach ($nameevents as $key => $value) {
                $s1 = $events[$key] + $s1;

                $evenobtenu = new EvenementObtenu();

                $evenobtenu->setName($value);
                $evenobtenu->setSomme($events[$key]);
                $evenobtenu->setSalaireevenobtenu($idsalaire);
                $manager->persist($evenobtenu);
                $manager->flush();
            }
        }

        if ($nameeventsvolontaire) {
            foreach ($nameeventsvolontaire as $key => $value) {
                $s2 = $s2 + $eventsvolontaire[$key];

                $evenobtenu = new EvenementObtenu();

                $evenobtenu->setName($value);
                $evenobtenu->setSomme($eventsvolontaire[$key]);
                $evenobtenu->setSalaireevenobtenu($idsalaire);
                $manager->persist($evenobtenu);
                $manager->flush();
            }
        }

        $T = ($mttotal + $p + $benefcotistion) - ($amicale + $cotisation + $s1 + $s2);

        $sal = $salaireRepository->find($idsalaire->getId());

        $sal->setMontantsalaire($T);

        $manager->persist($sal);
        $manager->flush();


        toastr()->addSuccess('Paiement ajouté');
        return $this->redirectToRoute('allsalaire', ['id' => $users->getId()]);
    }


    #[Route('/detailsalaire/{id}', name: 'detailsalaire')]
    public function detailsalaire(
        Salaire  $salaire,
        UserRepository $userRepository,
        SalaireRepository $salaireRepository,
        FunctionService    $functionService,
        PeriodeRepository $periodeRepository,
        PrimeObtenuRepository $primeObtenuRepository,
        EvenementObtenuRepository $evenementObtenuRepository,
        PrimeRepository $primeRepository
    ): Response {
        return $this->extracted($salaireRepository, $salaire, $userRepository, $periodeRepository, $functionService, $primeObtenuRepository, $evenementObtenuRepository, $primeRepository);
    }

    #[Route('salaire/deletesalaire/{id}', name: 'deletesalaire')]
    public function deletesalaire(
        Salaire     $salaire,
        UserRepository $userRepository,
        SalaireRepository $salaireRepository,
        PeriodeRepository $periodeRepository,
        PrimeObtenuRepository $primeObtenuRepository,
        EvenementObtenuRepository $evenementObtenuRepository,
        EntityManagerInterface $em
    ): JsonResponse {

        $em->remove($salaire);
        $em->flush();

        return new JsonResponse();
    }


    #[Route('/salaire/update/{id}', name: 'updatesalaire')]
    public function updatesalaire(
        Salaire               $salaires,
        UserRepository $userRepository,
        PrimeRepository $primeRepository,
        PrimeObtenuRepository $primeObtenuRepository,
        CotisationRepository  $cotisationRepository,
        Request $request,
        EntityManagerInterface $manager,
        PeriodeRepository     $periodeRepository,
        SalaireRepository $salaireRepository,
        EvenementObtenuRepository $evenementObtenuRepository
    ): Response {
        $periode = $request->get('periode');
        $mois = $request->get('mois');
        $nbrework = $request->get('nbrework');
        $mtfrais = $request->get('mtfrais');
        $mttotal = (($nbrework * $mtfrais) / 60);
        $amicale = $request->get('amicale');
        $cotisation = $request->get('cotisation');
        $benefcotistion = $request->get('benefcotistion');
        $prime = $request->get('prime');
        $idevents = $request->get('idevents');
        $sommeevents = $request->get('somme');

        $idperiode = $periodeRepository->find($periode);
        $primeobtenu = $primeObtenuRepository->findBy(['salaireprimeobtenu' => $salaires]);
        $s1 = 0;
        $s2 = 0;
        $p = 0;


        $salaire = $salaireRepository->find($salaires);

        $user = $userRepository->find($salaire->getUsersalaire());

        $salaire->setPeriodesalaire($idperiode);
        $salaire->setMois($mois);
        $salaire->setNbretravail($nbrework);
        $salaire->setMontantfrais($mtfrais);
        $salaire->setMontantsalaire(0);
        $salaire->setAmical($amicale);
        $salaire->setCotisation($cotisation);
        $salaire->setBenefcotisation($benefcotistion);

        $manager->persist($salaire);
        $manager->flush();

        foreach ($primeobtenu as $item) {
            $manager->remove($item);
            $manager->flush();
        }

        if ($prime) {
            foreach ($prime as $value) {
                $primeobtenu = new PrimeObtenu();

                $primeinfo = $primeRepository->findOneBy(['name' => $value]);

                $p = $p + $primeinfo->getSomme();

                $primeobtenu->setName($primeinfo->getName());
                $primeobtenu->setSomme($primeinfo->getSomme());
                $primeobtenu->setSalaireprimeobtenu($salaires);
                $manager->persist($primeobtenu);
                $manager->flush();
            }
        }


        foreach ($idevents as $key => $value) {
            $evenobtenu = $evenementObtenuRepository->find($value);

            $s2 = $s2 + $sommeevents[$key];

            $evenobtenu->setSomme($sommeevents[$key]);
            $manager->persist($evenobtenu);
            $manager->flush();
        }


        $T = ($mttotal + $p + $benefcotistion) - ($amicale + $cotisation + $s1 + $s2);



        $salaire->setMontantsalaire($T);

        $manager->persist($salaire);
        $manager->flush();


        toastr()->addSuccess('Paiement modifié');
        return $this->redirectToRoute('allsalaire', ['id' => $user->getId()]);
    }

    #[Route('/choixmois', name: 'choixmois')]
    public function moispaiement(Request $request, CotisationRepository $cotisationRepository): JsonResponse
    {
        $mois = $request->request->get('mois');
        $id = $request->request->getInt('idteacher');

        $somme = $cotisationRepository->findOneBy(['moisbouffe' => $mois, 'usercotisation' => $id]);

        // montant à bouffer
        $montantbouffe = $cotisationRepository->CotisationByMontant($somme->getSomme());


        return new JsonResponse(['mois' => $montantbouffe]);
    }

    #[Route('/periodepaiement', name: 'periodepaiement')]
    public function periodepaiement(Request $request, SalaireRepository $salaireRepository): JsonResponse
    {
        $periode = $request->request->get('periode');
        $id = $request->request->getInt('idteacher');

        $somme = $salaireRepository->findOneBy(['periodesalaire' => $periode, 'usersalaire' => $id]);

        return new JsonResponse(['somme' => $somme->getMontantfrais()]);
    }

    /**
     * @param SalaireRepository $salaireRepository
     * @param Salaire $salaire
     * @param UserRepository $userRepository
     * @param PeriodeRepository $periodeRepository
     * @param FunctionService $functionService
     * @param PrimeObtenuRepository $primeObtenuRepository
     * @param EvenementObtenuRepository $evenementObtenuRepository
     * @param PrimeRepository $primeRepository
     * @return Response
     */
    public function extracted(SalaireRepository $salaireRepository, Salaire $salaire, UserRepository $userRepository, PeriodeRepository $periodeRepository, FunctionService $functionService, PrimeObtenuRepository $primeObtenuRepository, EvenementObtenuRepository $evenementObtenuRepository, PrimeRepository $primeRepository): Response
    {
        $salaires = $salaireRepository->find($salaire);
        $nameuser = $userRepository->find($salaires->getUsersalaire());
        $periode = $periodeRepository->PeriodeByTeacher($salaires->getUsersalaire());
        $annee = $functionService->annees();
        $primeobtenu = $primeObtenuRepository->findBy(['salaireprimeobtenu' => $salaire]);
        $even = $evenementObtenuRepository->findBy(['salaireevenobtenu' => $salaire]);
        $prime = $primeRepository->findAll();

        $primerest = array_diff($prime, $primeobtenu);
        return $this->render('salaire/edit.html.twig', [

            'nameuser' => $nameuser,
            'salaires' => $salaires,
            'annees' => $annee,
            'periodes' => $periode,
            'primeobtenus' => $primeobtenu,
            'primes' => $primerest,

            'evens' => $even,

        ]);
    }


    #[Route('/recusalaire/{id}', name: 'recusalaire')]
    public function recusalaire(
        Salaire               $salaires,
        UserRepository $userRepository,
        PrimeObtenuRepository $primeObtenuRepository,
        SalaireRepository $salaireRepository,
        EvenementObtenuRepository $evenementObtenuRepository
    ): Response {

        $salaire = $salaireRepository->find($salaires);
        $prime = $primeObtenuRepository->findBy(['salaireprimeobtenu' => $salaires]);
        $events = $evenementObtenuRepository->findBy(['salaireevenobtenu' => $salaires]);
        $nameuser = $userRepository->find($salaire->getUsersalaire());
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
        $html = $this->renderView('salaire/recu.html.twig', [
            'salaire' => $salaire,
            'primes' => $prime,
            'nameuser' => $nameuser,
            'events' => $events,

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'Bulletin-de-paie' . '.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);


        return new Response();
    }
}
