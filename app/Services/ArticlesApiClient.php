<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ArticlesApiClient
{
    private string $baseUrl;
    private int $authClientId;
    private string $authSecret;

    public function __construct()
    {
        $this->baseUrl = config('services.articles.url');
        $this->authClientId = config('services.articles.auth_client');
        $this->authSecret = config('services.articles.auth_secret');
    }

    public function getToken(): string
    {
        $url = "{$this->baseUrl}/oauth/token";
        $response = Http::asForm()->post($url, [
            'grant_type' => 'client_credentials',
            'client_id' => $this->authClientId,
            'client_secret' => $this->authSecret
        ]);

        return $response->json()['access_token'];
    }

    public function getAllArticles($currentPage = 1): array
    {
        $token = $this->getToken();
        $url = "{$this->baseUrl}/api/articles?page={$currentPage}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get($url);

        return $response->json();
    }

    public function getSingleArticle($id): array
    {
        $token = $this->getToken();
        $url = "{$this->baseUrl}/api/articles/{$id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get($url);

        return $response->json();
    }
}

