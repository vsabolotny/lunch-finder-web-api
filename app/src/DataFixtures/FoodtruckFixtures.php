<?php

namespace App\DataFixtures;

use App\Entity\Foodtruck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class FoodtruckFixtures extends Fixture
{
    protected array $foodtrucks = [
        'BurgerOne',
        'SpringRoles 77',
        'Pasta For Diner',
        'Würstchen Mann',
        'Dönerbude',
        'Schnitzelbude',
    ];

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->foodtrucks as $foodtruck) {
            $foodtruckEntity = $this->createFoodtruck($foodtruck);
            $manager->persist($foodtruckEntity);
        }

        for ($i = 0; $i < random_int(10, 40); ++$i) {
            $foodtruckEntity = $this->createFoodtruck($this->faker->name);
            $manager->persist($foodtruckEntity);
        }

        $manager->flush();
    }

    protected function createFoodtruck(string $name): Foodtruck
    {
        $foodtruck = new Foodtruck();
        $foodtruck->setName($name)
            ->setWebsite($this->faker->url)
            ->setDescription($this->faker->realText())
        ;

        return $foodtruck;
    }
}
