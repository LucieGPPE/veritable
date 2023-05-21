<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/login', name: 'app_auth')]
    public function index(Request $request,PasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        // Récupérer les erreurs de connexion, s'il y en a
   $error= "Une erreur est survenue";

    // Vérifier les informations d'authentification uniquement si le formulaire a été soumis
    if ($email !== null) {
        // Récupérer l'utilisateur à partir de la base de données en utilisant le nom d'utilisateur
        $user = $doctrine->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if (!$user || !$passwordHasher->verify($user->getMotDePasse(),$password)) {
            // Gérer l'échec de l'authentification
            // Vous pouvez définir un message d'erreur personnalisé ici ou effectuer d'autres actions
            $this->addFlash('error', 'Identifiants invalides.');
        } else {
            // L'authentification est réussie, vous pouvez effectuer des actions supplémentaires si nécessaire
            // Par exemple, rediriger vers une page spécifique pour les utilisateurs connectés avec succès
            return $this->redirectToRoute('app_home');
        }
    }

    return $this->render('auth/login.html.twig', [
        'email' => $email,
        'error' => $error,
    ]);
    }


    #[Route('/login', name: 'app_register')]
    public function register( RequestStack $requestStack,Request $request, PasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine): Response
    {
        // Récupérer les données du formulaire d'inscription
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $name = $request->request->get('name');
        $firstName = $request->request->get('firstName');
        $numTel = $request->request->get('numTel');
        
        

        // Créer une nouvelle instance d'utilisateur
        $user = new Utilisateur();
        $user->setEmail($email);

        // Hasher le mot de passe
        $hashedPassword = $passwordHasher->hash($password);
        $user->setMotDePasse($hashedPassword);

        // Enregistrer l'utilisateur dans la base de données
        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Ajouter un message flash de succès
        $this->addFlash('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');

        $referer = $requestStack->getCurrentRequest()->headers->get('referer');
        $redirectUrl = $referer ?: $this->generateUrl('app_home');

        // Rediriger l'utilisateur vers la page de connexion
        return $this->redirectToRoute($redirectUrl);
    }
}
