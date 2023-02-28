<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IArticlesFetchRepository;
use Illuminate\Support\Facades\Http;

class NewsApiArticlesRepository implements IArticlesFetchRepository{

    public function getArticles()
    {
        $apiKey = env('OPEN_NEWS_API_KEY', '');
        $today = now()->yesterday()->toDateString();
        $url = "https://newsapi.org/v2/everything?q=*&apiKey={$apiKey}&from={$today}&pageSize=10";
        $response = Http::get($url);

        if($response->status() == '200')
        {
            return array(
                'status'=>'ok',
                'data'=>$response->json('articles')
            );
        }
        return array(
            'status'=>'error',
            'data'=>[]
        );
    }

    //trim articles
    public function trimArticles($articles)
    {
        $trimArticles = [];

        if(is_null($articles))
        {
            return $trimArticles;
        }
        else{
            foreach($articles as $article)
            {
                $pubDate = date('d M Y',strtotime($article["publishedAt"]));
                array_push($trimArticles, [
                    'source'=>$article["source"]["name"],
                    'author'=>$article["author"],
                    'title'=>$article["title"],
                    'description'=>$article["description"],
                    'url'=>$article["url"],
                    'image'=>$article["urlToImage"],
                    'published_date'=>$pubDate,
                    'content'=>$article["content"],
                ]);
            }

            return $trimArticles;
        }
    }

    public function getArticlesByCategory($category)
    {
        $apiKey = env('OPEN_NEWS_API_KEY', '');
        $today = now()->yesterday()->toDateString();
        $url = "https://newsapi.org/v2/everything?q={$category}&apiKey={$apiKey}&from={$today}&pageSize=10";
        $response = Http::get($url);

        if($response->status() == '200')
        {
            return array(
                'status'=>'ok',
                'data'=>$response->json('articles')
            );
        }
        return array(
            'status'=>'error',
            'data'=>[]
        );
    }

    public function getArticlesBySearch($search)
    {
        $apiKey = env('OPEN_NEWS_API_KEY', '');
        $today = now()->yesterday()->toDateString();
        $url = "https://newsapi.org/v2/everything?q={$search}&apiKey={$apiKey}&from={$today}&pageSize=10";
        $response = Http::get($url);

        if($response->status() == '200')
        {
            return array(
                'status'=>'ok',
                'data'=>$response->json('articles')
            );
        }
        return array(
            'status'=>'error',
            'data'=>[]
        );
    }

    public function getArticlesBySearchAndSource($search, $source)
    {
        if($source != 'News Org')
        {
            return array(
                'status'=>'ok',
                'data'=>[]
            );
        }
        else{
            return $this->getArticlesBySearch($search);
        }
    }

    public function getArticlesBySearchSourceAndCategory($search, $source, $category)
    {
        if($source != 'News Org')
        {
            return array(
                'status'=>'ok',
                'data'=>[]
            );
        }
        else{
            $apiKey = env('OPEN_NEWS_API_KEY', '');
            $today = now()->yesterday()->toDateString();
            $url = "https://newsapi.org/v2/everything?q={$search} AND {$category}&apiKey={$apiKey}&from={$today}&pageSize=10";
            $response = Http::get($url);

            if($response->status() == '200')
            {
                return array(
                    'status'=>'ok',
                    'data'=>$response->json('articles')
                );
            }
            return array(
                'status'=>'error',
                'data'=>[]
            );
        }
    }

    public function getArticlesBySource($source)
    {
        if($source != 'News Org')
        {
            return array(
                'status'=>'ok',
                'data'=>[]
            );
        }
        else{
            return $this->getArticles();
        }
    }

    public function getArticlesBySourceAndCategory($source, $category)
    {
        if($source != 'NY Times')
        {
            return array(
                'status'=>'ok',
                'data'=>[]
            );
        }
        else{
            return $this->getArticlesByCategory($category);
        }
    }
}
