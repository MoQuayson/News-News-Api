<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\INewsFeedsRepository;
use Illuminate\Http\Request;

class NewsFeedsController extends Controller
{
    private $newsFeedRepo;

    public function __construct(INewsFeedsRepository $newsFeedRepo) {
        $this->newsFeedRepo = $newsFeedRepo;
    }

    //get articles
    public function getArticles()
    {
        return response()->json($this->newsFeedRepo->getFeeds(),200);
    }

    //get articles by search
    public function getArticlesBySearch(Request $request)
    {
        return response()->json($this->newsFeedRepo->getFeedsBySearch($request),200);
    }

    //get articles by preference
    public function getArticlesByPreference()
    {
        return response()->json($this->newsFeedRepo->getFeedsByPreference(),200);
    }

}
