<?php

namespace App\Controller\Admin;

use App\Entity\Duree;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DureeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Duree::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            NumberField::new('pourcentage'),
        ];
    }
    
}
