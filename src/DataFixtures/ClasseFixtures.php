<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr FR');

        $data = [
            '4ème',
            '3ème',
            '2ndA',
            '1ère A',
            '1ère D',
            '1ère C',
            'Tle D',
            'Tle C',
        ];

        for ($i = 0; $i < count($data); $i++) {
            $classe = new Classe();

            $classe
                ->setName($data[$i])
                ->setFrais($faker->randomElement(['5000','8000','10000']));

            $manager->persist($classe);

        }
        $manager->flush();

    }
}
