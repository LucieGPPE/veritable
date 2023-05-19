<?php

namespace App\Controller\Admin;

use App\Entity\TypeAbonnement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeAbonnementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeAbonnement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
        ];
    }
    
}
