<?php

namespace App\DataFixtures;

use App\Controller\PeriodeController;
use App\Entity\User;
use App\Repository\ClasseRepository;
use App\Repository\PeriodeRepository;
use App\Service\FunctionService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class StudentFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $hasher, FunctionService $functionService, ClasseRepository $classeRepository, PeriodeRepository $periodeRepository)
    {
        $this->hasher = $hasher;
        $this->functionService = $functionService;
        $this->classeRepository = $classeRepository;
        $this->periodeRepository = $periodeRepository;
    }

    public function load(ObjectManager $manager,): void
    {
        $faker = Factory::create('fr FR');


        $periode = $this->periodeRepository->findAll();
        $classe = $this->classeRepository->findAll();


        for ($i = 0; $i <= 8; $i++) {
            $user = new User();
            $password = $this->hasher->hashPassword(
                $user,
                '123456',
            );
            $name = $faker->firstName(gender: null );
            $user
                ->setFirstname($name)
                ->setLastname($faker->lastName)
                ->setRoles(['ROLE_STUDENT'])
                ->setPassword($password)
                ->setAnnee($this->functionService->annee())
                ->setEmail($name . '@groupesucess.com')
                ->setIsTeacher(false)
                ->setMatricule($this->functionService->encodematricule())
                ->setQuartier($faker->city)
                ->setPhone($faker->unixTime($max = 'now') )
                ->addUserperiode($faker->randomElement($periode))
                ->addUserclasse($faker->randomElement($classe))
                ->setIsRame($faker->randomElement(['true','false']));

            $manager->persist($user);
            $manager->flush();
                }


    }
}
