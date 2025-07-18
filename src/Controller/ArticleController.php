<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    public function __construct(private readonly ArticleRepository $articleRepository)
    {
    }

    #[Route('/articles', name: 'articles.index')]
    public function index(): Response
    {
        $articles = $this->articleRepository->findAll();

        return $this->json($articles);
    }

    #[Route('/articles/{id<\d+>}', name: 'articles.show')]
    public function show(Article $article): Response
    {
        return $this->json($article);
    }
}
