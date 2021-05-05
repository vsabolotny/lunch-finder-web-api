<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    protected array $users = [
        'eugen@find-a-lunch.de',
        'vlad@find-a-lunch.de',
    ];

    public function __construct(
        private UserPasswordEncoderInterface $passwordEncoder,
    ) {}

    public function load(ObjectManager $manager): void
    {
        foreach ($this->users as $user) {
            $userEntity = new User();
            $userEntity->setEmail($user);
            $userEntity->setRoles(['ROLE_ADMIN']);
            $userEntity->setPassword($this->passwordEncoder->encodePassword(
                $userEntity,
                '1234567890'
            ));

            $manager->persist($userEntity);
        }

        $manager->flush();
    }
}
