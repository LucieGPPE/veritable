<?php

namespace App\Controller\Admin;

use App\Entity\Certification;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CertificationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Certification::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            ImageField::new('lien_image')->setUploadDir('/public/uploads/img/')
                ->setBasePath('uploads/img/'),
        ];
    }


}
