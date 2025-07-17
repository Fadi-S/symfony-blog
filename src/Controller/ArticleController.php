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

        return new Response(
            json_encode(array_map(
                fn($article) => [
                    'id' => $article->getId(),
                    'title' => $article->getTitle(),
                    'content' => $article->getContent(),
                    'created_at' => $article->getCreatedAt()->format('Y-m-d H:i:s'),
                    'updated_at' => $article->getUpdatedAt()->format('Y-m-d H:i:s'),
                ],
                $articles
            )),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/articles/{id<\d+>}', name: 'articles.show')]
    public function show(Article $article): Response
    {
        return new Response(json_encode([
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'created_at' => $article->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $article->getUpdatedAt()->format('Y-m-d H:i:s'),
        ]), 200, [
            'Content-Type' => 'application/json',
        ]);
    }
}
