<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AbonnementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Abonnement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            DateField::new('date_fin'),
            DateField::new('date_debut'),
            AssociationField::new('duree'),
            AssociationField::new('type_abonnement')
        ];
    }

}
