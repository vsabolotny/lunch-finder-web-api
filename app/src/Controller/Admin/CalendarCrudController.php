<?php

namespace App\Controller\Admin;

use App\Entity\Calendar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CalendarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Calendar::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('foodtruck');
        yield AssociationField::new('monday');
        yield AssociationField::new('tuesday');
        yield AssociationField::new('wednesday');
        yield AssociationField::new('thursday');
        yield AssociationField::new('friday');
        yield AssociationField::new('saturday');
        yield AssociationField::new('sunday');
    }
}
