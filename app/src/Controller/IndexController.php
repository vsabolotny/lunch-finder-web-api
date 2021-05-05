<?php

namespace App\Controller;

use App\Form\FeedbackType;
use App\Repository\EventRepository;
use App\Repository\FoodtruckRepository;
use DateTime;
use DateTimeZone;
use Fungio\GoogleMap\Base\Coordinate;
use Fungio\GoogleMap\Map;
use Fungio\GoogleMap\Overlays\InfoWindow;
use Fungio\GoogleMap\Overlays\Marker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function __construct(private FoodtruckRepository $foodtruckRepository)
    {}

    #[Route('/appdata', name: 'appdata')]
    public function getData(EventRepository $eventRepository): JsonResponse
    {
        date_default_timezone_set('Europe/Berlin');

        $result = [];

        $events = $eventRepository->findAll();
        foreach ($events as $event) {
            if ($event->getDay()->getName() !== date('l')) {
                continue;
            }

            $now = new DateTime(date('1970-01-01 H:i:s'), new DateTimeZone('Europe/Berlin'));
            if ($event->getFromTime()->getTimestamp() > $now->getTimestamp()) {
                continue;
            }

            if ($event->getToTime()->getTimestamp() < $now->getTimestamp()) {
                continue;
            }

            $location = $event->getLocation();
            if ($location === null) {
                continue;
            }

            $foodtruck = $event->getFoodtruck();
            if ($foodtruck === null) {
                continue;
            }

            $result[] = [
                'id' => $event->getId(),
                'location' => [
                    'latitude' => $location->getLatitude(),
                    'longitude' => $location->getLongitude(),
                ],
                'foodtruck' => [
                    'name' => $foodtruck->getName(),
                    'tags' => implode(', ', $foodtruck->getTags()->toArray()),
                    'logoFile' => $foodtruck->getLogoFile(),
                ],
            ];
        }

        return $this->json($result);
    }

    #[Route('/', name: 'index')]
    public function index(Map $map, EventRepository $eventRepository): Response
    {
        date_default_timezone_set('Europe/Berlin');

        $events = $eventRepository->findAll();
        foreach ($events as $event) {
            if ($event->getDay()->getName() !== date('l')) {
                continue;
            }

            $now = new DateTime(date('1970-01-01 H:i:s'), new DateTimeZone('Europe/Berlin'));
            if ($event->getFromTime()->getTimestamp() > $now->getTimestamp()) {
                continue;
            }

            if ($event->getToTime()->getTimestamp() < $now->getTimestamp()) {
                continue;
            }

            $location = $event->getLocation();
            if ($location === null) {
                continue;
            }

            $foodtruck = $event->getFoodtruck();
            $map->addMarker(new Marker(
                new Coordinate(
                    $location->getLatitude() + random_int(1, 10) / 100000,
                    $location->getLongitude() + random_int(1, 10) / 100000,
                ),
                null,
                null,
                null,
                null,
                new InfoWindow(
                    $this->renderView('index/foodtruck.html.twig', ['foodtruck' => $foodtruck]),
                 ),
            ));
        }

        return $this->render('index/index.html.twig', [
            'map' => $map,
            'infoWindow' => $map->getJavascriptVariable(),
            'foodtruckCount' => $this->foodtruckRepository->count([]),
            'isApp' => false,
        ]);
    }

    #[Route('/imprint/{isApp}', name: 'imprint', defaults: ['isApp' => false])]
    public function imprint(bool $isApp = false): Response
    {
        return $this->render('index/imprint.html.twig', [
            'foodtruckCount' => $this->foodtruckRepository->count([]),
            'isApp' => $isApp,
        ]);
    }

    #[Route('/feedback/{isApp}', name: 'feedback', defaults: ['isApp' => false])]
    public function feedback(Request $request, bool $isApp = false): Response
    {
        $form = $this->createForm(FeedbackType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $feedback = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feedback);
            $entityManager->flush();

            $this->addFlash('success', 'Danke für dein Feedback');

            return $this->redirectToRoute('feedback', ['isApp' => $isApp]);
        }

        return $this->render('index/feedback.html.twig', [
            'form' => $form->createView(),
            'foodtruckCount' => $this->foodtruckRepository->count([]),
            'isApp' => $isApp,
        ]);
    }
}
