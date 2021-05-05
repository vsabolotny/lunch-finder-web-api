<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FeedbackFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < random_int(50, 150); ++$i) {
            $feedback = new Feedback();
            $feedback->setName($faker->name);
            $feedback->setEmailAddress($faker->email);
            $feedback->setContent($faker->realText());

            $manager->persist($feedback);
        }

        $manager->flush();
    }
}
