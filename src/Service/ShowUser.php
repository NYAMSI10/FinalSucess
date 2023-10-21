<?php

namespace App\Service;

use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use App\Repository\PeriodeRepository;

class ShowUser
{

    public function __construct(private ClasseRepository $classeRepository,private MatiereRepository $matiereRepository, private PeriodeRepository $periodeRepository)
        {

        }

    public  function classeRestant( $users)
    {
        $userclasse = $this->classeRepository->ClasseByStudent($users->getId());
        $allclasse = $this->classeRepository->findAll();

       return array_diff($allclasse,$userclasse);

    }
    public  function matiereRestant( $users)
    {
        $usermat = $this->matiereRepository->MatiereByTeacher($users->getId());
        $allmat = $this->matiereRepository->findAll();

       return array_diff($allmat,$usermat);

    }
    public  function periodeRestant( $users)
    {
        $userperio = $this->periodeRepository->PeriodeByTeacher($users->getId());
        $allperio = $this->periodeRepository->findAll();

       return array_diff($allperio,$userperio);

    }



}
