<?php

namespace App\DataFixtures;

use App\Entity\Day;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DayFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($days as $name) {
            $day = new Day();
            $day->setName($name);
            $manager->persist($day);
        }
        $manager->flush();
    }
}
