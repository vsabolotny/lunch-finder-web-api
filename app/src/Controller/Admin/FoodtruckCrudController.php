<?php

namespace App\Controller\Admin;

use App\Entity\Foodtruck;
use App\Form\EventType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FoodtruckCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['name' => 'ASC'])
            ->setSearchFields(['name'])
            ->setPaginatorPageSize(100)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('website')
            ->add('tags')
        ;
    }

    public static function getEntityFqcn(): string
    {
        return Foodtruck::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Anmeldung')
                ->setHelp('Alle Felder in diesem Bereich sind pflicht'),
            TextField::new('name'),
            TextareaField::new('description', 'Beschreibung')
                ->hideOnIndex(),
            UrlField::new('website'),
            Field::new('logoFile', 'Logo')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),
            AssociationField::new('tags')
                ->setSortable(true)
                ->autocomplete(),

            FormField::addPanel('Event')
                ->setHelp('Mindestens ein Event muss existieren'),
            CollectionField::new('events')
                ->allowAdd()
                ->setEntryType(EventType::class),
        ];
    }

}
