<?php

namespace App\Controller\Admin;

use App\Entity\Box;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class BoxCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Box::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            NumberField::new('prix'),
            AssociationField::new('produit'),
            TextEditorField::new('description')
        ];
    }


}
