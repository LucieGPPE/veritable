<?php

namespace App\Controller\Admin;

use App\Entity\Box;
use App\Entity\Categorie;
use App\Entity\Certification;
use App\Entity\Commande;
use App\Entity\Image;
use App\Entity\Avis;
use App\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Configurator\TextEditorConfigurator;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\ProduitCrudController;
use App\Entity\Abonnement;
use App\Entity\Client;
use App\Entity\Duree;
use App\Entity\Produit;
use App\Entity\TypeAbonnement;
use App\Entity\Utilisateur;

class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Veritable');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Box', 'fas fa-list', Box::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-list', Image::class);
        yield MenuItem::linkToCrud('Certifications', 'fas fa-list', Certification::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-list', Avis::class);
        yield MenuItem::linkToCrud('Commande', 'fas fa-list', Commande::class);
        yield MenuItem::linkToCrud('Ingredient', 'fas fa-list', Ingredient::class);
        yield MenuItem::linkToCrud('Abonnement', 'fas fa-list', Abonnement::class);
        yield MenuItem::linkToCrud('Durée', 'fas fa-list', Duree::class);
        yield MenuItem::linkToCrud('Type d\'abonnement', 'fas fa-list', TypeAbonnement::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', Utilisateur::class);
        yield MenuItem::linkToCrud('Client', 'fas fa-list', Client::class);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('title')
        ];
    }
}
