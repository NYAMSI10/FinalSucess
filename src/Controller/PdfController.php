<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use App\Repository\PeriodeRepository;
use App\Repository\PresenceStudentRepository;
use App\Repository\UserRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    #[Route('/pdfabscence/periode?={idperiode}/classe?={idclasse}/jours?={createdAt}', name: 'pdfabscence')]
    public function pdfabscence($idperiode, $idclasse, $createdAt, ClasseRepository $classeRepository, MatiereRepository $matiereRepository,
                               PeriodeRepository $periodeRepository,UserRepository $userRepository, PresenceStudentRepository $presenceStudentRepository): Response
    {

        $absencestudent = $presenceStudentRepository->findOneBy(['datejours' => $createdAt, 'periodepresence' => $idperiode, 'classepresence' => $idclasse]);


        $a = $userRepository->studentBypresence($absencestudent->getId());
        $b = $userRepository->studentByperioclasse($absencestudent->getPeriodepresence()->getId(),$absencestudent->getClassepresence()->getId());


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
        $html = $this->renderView('pdf/abscence.html.twig', [
            'absencestudents' => array_diff($b,$a),
            'absent'=>$absencestudent,
            'datejours' => $createdAt,

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'Liste-des-absents-du-'. $createdAt . '.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);


        return new Response();
    }



    #[Route('/pdfallabscence/jours?={createdAt}', name: 'pdfallabscence')]
    public function pdfallabscence($idperiode, $idclasse, $createdAt, ClasseRepository $classeRepository, MatiereRepository $matiereRepository,
                                PeriodeRepository $periodeRepository,UserRepository $userRepository, PresenceStudentRepository $presenceStudentRepository): Response
    {

        $absencestudent = $presenceStudentRepository->findOneBy(['datejours' => $createdAt, 'periodepresence' => $idperiode, 'classepresence' => $idclasse]);


        $a = $userRepository->studentBypresence($absencestudent->getId());
        $b = $userRepository->studentByperioclasse($absencestudent->getPeriodepresence()->getId(),$absencestudent->getClassepresence()->getId());


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
        $html = $this->renderView('pdf/abscence.html.twig', [
            'absencestudents' => array_diff($b,$a),
            'absent'=>$absencestudent,
            'datejours' => $createdAt,

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'Liste-des-absents-du-'. $createdAt . '.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);


        return new Response();
    }
}
