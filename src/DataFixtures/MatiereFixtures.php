<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use App\Entity\Periode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MatiereFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr FR');

        $data = [
            'Maths',
            'Français',
            'Philo',
            'Anglais',
            'Littérature',
            'Chimie',
            'Physique',
            'Pct',

        ];

        for ($i = 0; $i < count($data); $i++) {
            $matiere = new Matiere();

            $matiere
                ->setName($data[$i]);


            $manager->persist($matiere);

        }
        $manager->flush();
    }
}
