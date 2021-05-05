<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends Fixture
{
    protected array $locations = [
        [
            'street' => 'Mövenstr.',
            'houseNumber' => '21',
            'postcode' => '85652',
            'city' => 'Pliening',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Erika-Mann-Str.',
            'houseNumber' => '55',
            'postcode' => '80636',
            'city' => 'München',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Ruth-Drexel-Str.',
            'houseNumber' => '203',
            'postcode' => '81927',
            'city' => 'München',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Auenstr.',
            'houseNumber' => '23',
            'postcode' => '85737',
            'city' => 'Ismaning',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Goethestr.',
            'houseNumber' => '8',
            'postcode' => '64668',
            'city' => 'Rimbach',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Am sonnigen Hang',
            'houseNumber' => '12',
            'postcode' => '64689',
            'city' => 'Grasellenbach',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Gießereistraße.',
            'houseNumber' => '10',
            'postcode' => '90763',
            'city' => 'Fürth',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Loburgerstraße.',
            'houseNumber' => '43',
            'postcode' => '48653',
            'city' => 'Coesfeld',
            'country' => 'Deutschland',
        ],
        [
            'street' => 'Anlohstraße',
            'houseNumber' => '7',
            'postcode' => '48653',
            'city' => 'Coesfeld',
            'country' => 'Deutschland',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->locations as $location) {
            $locationEntity = new Location();
            $locationEntity
                ->setFullAddress(sprintf(
                    '%s %s %s %s %s',
                    $location['street'],
                    $location['houseNumber'],
                    $location['postcode'],
                    $location['city'],
                    $location['country'],
                ))
            ;

            $manager->persist($locationEntity);
        }

        $manager->flush();
    }
}
