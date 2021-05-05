<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use GuzzleHttp\ClientInterface;

class Location implements EventSubscriber
{
    public function __construct(private ClientInterface $geocoderClient)
    {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    private function updateLocation(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof \App\Entity\Location) {
            return;
        }

        $response = $this->geocoderClient->request('GET', '', [
            'query' => [
                'key' => '%env(FUNGIO_GOOGLE_MAP_API_KEY)%',
                'address' => $entity->getFullAddress(),
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        $entity->setLatitude($result['results'][0]['geometry']['location']['lat']);
        $entity->setLongitude($result['results'][0]['geometry']['location']['lng']);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->updateLocation($args);
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->updateLocation($args);
    }
}
