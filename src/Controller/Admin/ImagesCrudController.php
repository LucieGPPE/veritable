<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('libelle')->setUploadDir('/public/uploads/img/')
                ->setBasePath('uploads/img/'),            TextField::new('lien'),
            ];
    }


}
