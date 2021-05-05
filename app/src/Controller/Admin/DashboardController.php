<?php

namespace App\Controller\Admin;

use App\Entity\Calendar;
use App\Entity\Day;
use App\Entity\Event;
use App\Entity\Feedback;
use App\Entity\Foodtruck;
use App\Entity\Location;
use App\Entity\Tag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Foodtruck')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Foodtrucks', 'fas fa-list', Foodtruck::class);
        #yield MenuItem::linkToCrud('Kalender', 'fas fa-list', Calendar::class);
        yield MenuItem::linkToCrud('Standorte', 'fas fa-list', Location::class);
        #yield MenuItem::linkToCrud('Events', 'fas fa-list', Event::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-list', Tag::class);
        #yield MenuItem::linkToCrud('Tage', 'fas fa-list', Day::class);
        yield MenuItem::linkToCrud('Feedback', 'fas fa-list', Feedback::class);
        yield MenuItem::linkToCrud('Benutzer', 'fas fa-list', User::class);
    }
}
