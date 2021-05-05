<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Repository\DayRepository;
use App\Repository\FoodtruckRepository;
use App\Repository\LocationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct(
        private LocationRepository $locationRepository,
        private FoodtruckRepository $foodtruckRepository,
        private DayRepository $dayRepository,
    )
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $locations = $this->locationRepository->findAll();
        $foodtrucks = $this->foodtruckRepository->findAll();
        $days = $this->dayRepository->findAll();

        for ($i = 0; $i < random_int(100, 300); ++$i) {
            $location = $locations[array_rand($locations)];
            $foodtruck = $foodtrucks[array_rand($foodtrucks)];
            $day = $days[array_rand($days)];

            $eventEntity = new Event();
            $eventEntity
                ->setFromTime($this->faker->dateTimeBetween('1970-01-01 00:00:00', '1970-01-01 12:00:00'))
                ->setToTime($this->faker->dateTimeBetween('1970-01-01 13:00:00', '1970-01-01 23:59:00'))
            ;

            $day->addEvent($eventEntity);
            $location->addEvent($eventEntity);
            $foodtruck->addEvent($eventEntity);

            $manager->persist($eventEntity);
            $manager->persist($location);
            $manager->persist($day);
            $manager->persist($foodtruck);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            LocationFixtures::class,
            DayFixtures::class,
        );
    }
}
