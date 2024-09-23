<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Utilisateur;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 423, message: "Vous n'avez pas les droits pour accéder à cette page")]
    #[Route('/admin', name: 'app_admin')]
    public function tabadmin(ArticleRepository $articleRepo,UtilisateurRepository $utilisateurRepo): Response
    {
        return $this->render('admin/index.html.twig', [
            'articles' => $articleRepo->findAll(),
            'utilisateurs'=> $utilisateurRepo->findAll()
        ]);
    }


    #[Route('/auteur', name: 'app_auteur')]
    public function tabauteur(ArticleRepository $articleRepo): Response
    {

        $utilisateur= $this->getUser();
        if ($utilisateur && $utilisateur instanceof Utilisateur) {
            $idU=$utilisateur->getId();
        }
        return $this->render('auteur/index.html.twig', [
            'articles' => $articleRepo->findBy(['utilisateur'=>$idU]),
        ]);

    }



}