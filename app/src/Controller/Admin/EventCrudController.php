<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['location' => 'ASC'])
            ->setSearchFields(['location'])
            ->setPaginatorPageSize(100)
        ;
    }

    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('fromTime'),
            TextField::new('toTime'),
            AssociationField::new('location')
                ->setSortable(true),
            AssociationField::new('foodtruck'),
            AssociationField::new('day'),
        ];
    }
}
