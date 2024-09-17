<?php

namespace App\Controller\API;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/article')]
final class ArticleController extends AbstractController
{

    #[Route('/recherche', name: 'app_article_recherche')]
    public function recherche(Request $request, ArticleRepository $articleRepository): JsonResponse
    {
        $content = $request->getContent();
        $para = json_decode($content, true);
      
        $titre = ($para['titre']);
        $categorie = ($para['categorie']);
        $genre = ($para['genre']);
        

        // dd($titre,$categorie, $genre);
        $article = $articleRepository->findByFiltres($titre, $categorie, $genre);


        return $this->json($article, context: ['groups' => 'api_recherche']);
        // return $this->render('article/show.html.twig', [
        //     'articles' => $articles,
        // ]);
    }
}
