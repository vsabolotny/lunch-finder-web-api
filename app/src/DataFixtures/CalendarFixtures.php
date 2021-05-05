<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Repository\FoodtruckRepository;
use App\Repository\LocationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CalendarFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private LocationRepository $locationRepository,
        private FoodtruckRepository $foodtruckRepository,
    ) {}

    public function load(ObjectManager $manager)
    {
        $locations = $this->locationRepository->findAll();
        $foodtrucks = $this->foodtruckRepository->findAll();

        $locations[] = null;
        $locations[] = null;
        $locations[] = null;
        $locations[] = null;
        $locations[] = null;
        $locations[] = null;

        foreach ($foodtrucks as $foodtruck) {
            $monday = $locations[array_rand($locations)];
            $tuesday = $locations[array_rand($locations)];
            $wednesday = $locations[array_rand($locations)];
            $thursday = $locations[array_rand($locations)];
            $friday = $locations[array_rand($locations)];
            $saturday = $locations[array_rand($locations)];
            $sunday = $locations[array_rand($locations)];

            $calendar = new Calendar();
            $calendar->setMonday($monday)
                ->setTuesday($tuesday)
                ->setWednesday($wednesday)
                ->setThursday($thursday)
                ->setFriday($friday)
                ->setSaturday($saturday)
                ->setSunday($sunday)
            ;

            $foodtruck->setCalendar($calendar);

            $manager->persist($calendar);
            $manager->persist($foodtruck);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            FoodtruckFixtures::class,
            LocationFixtures::class,
        );
    }
}
