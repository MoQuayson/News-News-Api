<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IArticlesFetchRepository;
use Illuminate\Support\Facades\Http;

class GuardianArticlesRepository implements IArticlesFetchRepository{

    public function getArticles()
    {
        $apiKey = env('GUARDIANS_API_KEY', '');
        $today = now()->toDateString();
        $url = "https://content.guardianapis.com/search?api-key={$apiKey}";
        $response = Http::get($url);

        return $response->json('response')['results'];
    }

    public function trimArticles($articles)
    {

    }

    public function getArticlesByCategory($category)
    {

    }

    public function getArticlesBySearch($search)
    {

    }

    public function getArticlesBySearchAndSource($search, $source)
    {

    }

    public function getArticlesBySearchSourceAndCategory($search, $source, $category)
    {

    }
    public function getArticlesBySource($source)
    {

    }

    public function getArticlesBySourceAndCategory($source, $category)
    {

    }
}
