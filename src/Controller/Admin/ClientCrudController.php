<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('adresse'),
            TextField::new('complement_adresse'),
            NumberField::new('code_postal'),
            TextField::new('ville'),
            DateField::new('date_naissance'),
            BooleanField::new('newsletter'),
            AssociationField::new('utilisateur')
        ];
    }
}
