<?php

namespace App\DataFixtures;

use App\Entity\Periode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PériodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr FR');

        $data = [
            'Jour',
            'Soir',
            'Vacance',


        ];

        for ($i = 0; $i < count($data); $i++) {
            $periode = new Periode();

            $periode
                ->setName($data[$i]);


            $manager->persist($periode);

        }
        $manager->flush();
    }
}
