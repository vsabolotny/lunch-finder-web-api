<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LocationCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle($crud::PAGE_EDIT, 'Foodtruck Definition')
            ->setDefaultSort(['fullAddress' => 'ASC'])
            ->setSearchFields(['fullAddress'])
            ->setPaginatorPageSize(100)
        ;
    }

    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield 'fullAddress';
    }
}
