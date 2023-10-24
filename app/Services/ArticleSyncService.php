<?php

namespace App\Services;

use App\Models\Article;

class ArticleSyncService
{
    protected $apiClient;
    protected $imageService;

    public function __construct(ArticlesApiClient $apiClient, ImageService $imageService)
    {
        $this->apiClient = $apiClient;
        $this->imageService = $imageService;
    }

    public function syncSingleArticle($id): void
    {
        $response = $this->apiClient->getSingleArticle($id);
        $articleFromAPI = $response['data'] ?? null;
        if ($articleFromAPI) {
            $articleData = $this->processArticle($articleFromAPI);
            Article::upsert($articleData, ['external_id'], ['title', 'img']);
        } else {
            Article::where('external_id', $id)->delete();
        }
    }

    public function syncAllArticles(): array
    {
        $currentPage = 1;
        $externalIdsFromAPI = [];

        $initialResponse = $this->apiClient->getAllArticles($currentPage);
        $lastPage = $initialResponse['meta']['last_page'];

        while ($currentPage <= $lastPage) {
            $articles = $currentPage === 1 ? $initialResponse : $this->apiClient->getAllArticles($currentPage);

            $externalIdsFromAPI = array_merge($externalIdsFromAPI, array_column($articles['data'], 'id'));

            $articlesData = collect($articles['data'])->map(function ($article) {
                return $this->processArticle($article);
            })->toArray();

            Article::upsert($articlesData, ['external_id'], ['title', 'img']);

            $currentPage++;
        }

        Article::whereNotIn('external_id', $externalIdsFromAPI)->delete();

        return $externalIdsFromAPI;
    }

    private function processArticle($article): array
    {
        $imagePath = $this->imageService->isImageUrlValid($article['image'])
            ? $this->imageService->downloadAndSaveImage($article['image'])
            : $article['image'];

        return [
            'external_id' => $article['id'],
            'title' => $article['title'],
            'img' => $imagePath,
        ];
    }
}

