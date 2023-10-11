<?php

namespace App\Service;

use App\Repository\ClasseRepository;
use App\Repository\MatiereRepository;
use App\Repository\PeriodeRepository;

class ShowUser
{
        public function __construct(ClasseRepository $classeRepository, MatiereRepository $matiereRepository, PeriodeRepository $periodeRepository)
        {
            $this->classeRepository = $classeRepository;
            $this->matiereRepository = $matiereRepository;
            $this->periodeRepository = $periodeRepository;
        }

    public  function classeRestant( $users)
    {
        $userclasse = $this->classeRepository->ClasseByStudent($users->getId());
        $allclasse = $this->classeRepository->findAll();

       return array_diff($allclasse,$userclasse);

    }
    public  function matiereRestant( $users)
    {
        $usermat = $this->classeRepository->ClasseByStudent($users->getId());
        $allmat = $this->classeRepository->findAll();

       return array_diff($allmat,$usermat);

    }
    public  function periodeRestant( $users)
    {
        $userperio = $this->classeRepository->ClasseByStudent($users->getId());
        $allperio = $this->classeRepository->findAll();

       return array_diff($allperio,$userperio);

    }



}
