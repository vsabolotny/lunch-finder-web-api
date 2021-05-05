<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Repository\FoodtruckRepository;
use App\Repository\TagRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TagFixtures extends Fixture
{
    protected array $tags = [
        'Super Essen',
        'Lecker',
        'Burger',
        'Chinesisch',
        'Döner',
        'Pasta',
        'Schnitzel',
        'Würstchen',
    ];

    public function __construct(
        private FoodtruckRepository $foodtruckRepository,
        private TagRepository $tagRepository,
    ) {}

    public function load(ObjectManager $manager): void
    {
        $foodtrucks = $this->foodtruckRepository->findAll();

        foreach ($this->tags as $tag) {
            $foodtruck = $foodtrucks[array_rand($foodtrucks)];

            $tagEntity = new Tag();
            $tagEntity
                ->setName($tag)
                ->addFoodtruck($foodtruck)
            ;

            $manager->persist($tagEntity);
        }

        $faker = Factory::create();
        for ($i = 0; $i < random_int(50, 150); ++$i) {
            $foodtruck = $foodtrucks[array_rand($foodtrucks)];

            $tagEntity = new Tag();
            $tagEntity
                ->setName($faker->word)
                ->addFoodtruck($foodtruck)
            ;

            $manager->persist($tagEntity);
        }

        $manager->flush();

        $tags = $this->tagRepository->findAll();
        foreach ($tags as $tag) {
            $foodtruck = $foodtrucks[array_rand($foodtrucks)];
            $tag->addFoodtruck($foodtruck);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
