<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IArticlesFetchRepository;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Http;

class NYTimesArticlesRepository implements IArticlesFetchRepository{

    public function getArticles()
    {
        $apiKey = env('NY_TIMES_API_KEY', '');
        $today = now()->yesterday()->toDateString();
        $url = "https://api.nytimes.com/svc/search/v2/articlesearch.json?q=&api-key={$apiKey}&fq=pub_date:({$today})";
        $response = Http::get($url);

        if($response->status() == '200')
        {
            return array(
                'status'=>'ok',
                'data'=>$response->json('response')["docs"]
            );
        }
        return array(
            'status'=>'error',
            'data'=>[]
        );

    }

    public function trimArticles($articles)
    {
        $trimArticles = [];
        $imageUrlPrepend = "https://static01.nyt.com/";

        if(is_null($articles))
        {
            return $trimArticles;
        }
        else{
            foreach($articles as $article)
            {
                //$pubDate = new DateTime($article["pub_date"]);
                //$pubDate->modify("DD-MM-YYYY");
                $pubDate = date('d M Y',strtotime($article["pub_date"]));

                $image = '';
                foreach($article["multimedia"] as $multimedia)
                {
                    $image = $multimedia['url'];
                    break;
                }

                array_push($trimArticles, [
                    'source'=>$article["source"],
                    'author'=>$article["source"],
                    'title'=>$article["headline"]["main"],
                    'description'=>$article["lead_paragraph"],
                    'url'=> $article["web_url"],
                    'image'=>$imageUrlPrepend .$image,
                    'published_date'=>$pubDate,
                    //'content'=>$article["content"],
                ]);
            }

            return $trimArticles;
        }
    }

    public function getArticlesByCategory($category)
    {
        $apiKey = env('NY_TIMES_API_KEY', '');
        $today = now()->yesterday()->toDateString();
        $url = "https://api.nytimes.com/svc/search/v2/articlesearch.json?q=&api-key={$apiKey}&fq=pub_date:({$today})&fq=news_desk:({$category})";
        $response = Http::get($url);

        if($response->status() == '200')
        {
            return array(
                'status'=>'ok',
                'data'=>$response->json('response')["docs"]
            );
        }
        return array(
            'status'=>'error',
            'data'=>[]
        );
    }

    public function getArticlesBySearch($search)
    {
        $apiKey = env('NY_TIMES_API_KEY', '');
        $today = now()->yesterday()->toDateString();
        $url = "https://api.nytimes.com/svc/search/v2/articlesearch.json?q={$search}&api-key={$apiKey}&fq=pub_date:({$today})";
        $response = Http::get($url);

        if($response->status() == '200')
        {
            return array(
                'status'=>'ok',
                'data'=>$response->json('response')["docs"]
            );
        }
        return array(
            'status'=>'error',
            'data'=>[]
        );
    }

    public function getArticlesBySearchAndSource($search, $source)
    {
        if($source != 'NY Times')
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
        if($source != 'NY Times')
        {
            return array(
                'status'=>'ok',
                'data'=>[]
            );
        }
        else{
            $apiKey = env('NY_TIMES_API_KEY', '');
            $today = now()->yesterday()->toDateString();
            $url = "https://api.nytimes.com/svc/search/v2/articlesearch.json?q={$search}&api-key={$apiKey}&fq=pub_date:({$today})&fq=news_desk:({$category})";
            $response = Http::get($url);

            if($response->status() == '200')
            {
                return array(
                    'status'=>'ok',
                    'data'=>$response->json('response')["docs"]
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
        if($source != 'NY Times')
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
