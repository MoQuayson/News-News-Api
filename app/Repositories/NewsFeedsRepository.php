<?php


namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IArticlesFetchRepository;
use App\Repositories\Interfaces\IFeedsPreferenceRepository;
use App\Repositories\Interfaces\INewsFeedsRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class NewsFeedsRepository implements INewsFeedsRepository{
    private $feedPreferenceRepo;
    private $nyTimesArticlesRepo;
    private $guardianArticlesRepo;
    private $newsApiArticlesRepo;
    private $test;

    public function __construct(IFeedsPreferenceRepository $feedPreferenceRepo,
    NYTimesArticlesRepository $nyTimesArticlesRepo,NewsApiArticlesRepository $newsApiArticlesRepo,
    GuardianArticlesRepository $guardianArticlesRepo
    )
    {
        $this->feedPreferenceRepo = $feedPreferenceRepo;
        $this->nyTimesArticlesRepo = $nyTimesArticlesRepo;
        $this->newsApiArticlesRepo = $newsApiArticlesRepo;
        $this->guardianArticlesRepo = $guardianArticlesRepo;
    }


    /** GET: /api/feeds
     *  Get Feeds
     *  @return response()->json()
     */
    public function getFeeds()
    {
        try {
            $user = User::getCurrentUser();
        //$preferences = $this->feedPreferenceRepo->getPreferences($user->id);

        $newsAPIArticles = $this->newsApiArticlesRepo->getArticles();
        if($newsAPIArticles["status"] == 'error')
        {
            $newsAPIArticles = [];
        }
        $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

        //ny times
        $articlesResponse =  $this->nyTimesArticlesRepo->getArticles();
        if($articlesResponse["status"] == 'error')
        {
            $articlesResponse = [];
        }
        $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

        $data = array(
            'status'=>"ok",
            'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
            'news_api_articles'=>$newsAPIArticles,
            'ny_times_articles'=>$nyTimesArticles,
        );
        return $data;
        } catch (Exception) {
            //throw $th;
        }
    }

    /** GET: /api/feeds/search
     *  Get Feeds By Search
     *  @param Request $request
     *  @return response()->json()
     */
    public function getFeedsBySearch($request)
    {
        $search = $request->search;
        $source = $request->source;
        $category = $request->category;

        //all null
        if(is_null($search) && is_null($source) && is_null($category))
        {
            return  $this->getFeeds();
        }

        //user searched only
        if(!is_null($search) && is_null($source) && is_null($category))
        {
            //get by search
            $newsAPIArticles = $this->newsApiArticlesRepo->getArticlesBySearch($search);
            if($newsAPIArticles["status"] == 'error')
            {
                $newsAPIArticles = [];
            }
            $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

            //ny times
            $articlesResponse =  $this->nyTimesArticlesRepo->getArticlesBySearch($search);
            if($articlesResponse["status"] == 'error')
            {
                $articlesResponse = [];
            }
            $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>$newsAPIArticles,
                'ny_times_articles'=>$nyTimesArticles,
            );
            return $data;
        }

        //user search and source only
        if(!is_null($search) && !is_null($source) && is_null($category))
        {
            //get by search
            $newsAPIArticles = $this->newsApiArticlesRepo->getArticlesBySearchAndSource($search,$source);
            if($newsAPIArticles["status"] == 'error')
            {
                $newsAPIArticles = [];
            }
            $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

            //ny times
            $articlesResponse =  $this->nyTimesArticlesRepo->getArticlesBySearchAndSource($search,$source);
            if($articlesResponse["status"] == 'error')
            {
                $articlesResponse = [];
            }
            $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>$newsAPIArticles,
                'ny_times_articles'=>$nyTimesArticles,
            );
            return $data;
        }

        //user selects search, source and category
        if(!is_null($search) && !is_null($source) && !is_null($category))
        {
            //get by search
            $newsAPIArticles = $this->newsApiArticlesRepo->getArticlesBySearchSourceAndCategory($search,$source,$category);
            if($newsAPIArticles["status"] == 'error')
            {
                $newsAPIArticles = [];
            }
            $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

            //ny times
            $articlesResponse =  $this->nyTimesArticlesRepo->getArticlesBySearchSourceAndCategory($search,$source,$category);
            if($articlesResponse["status"] == 'error')
            {
                $articlesResponse = [];
            }
            $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>$newsAPIArticles,
                'ny_times_articles'=>$nyTimesArticles,
            );
            return $data;
        }

        //user selects only category
        if(is_null($search) && is_null($source) && !is_null($category))
        {
            //get by search
            $newsAPIArticles = $this->newsApiArticlesRepo->getArticlesByCategory($category);
            if($newsAPIArticles["status"] == 'error')
            {
                $newsAPIArticles = [];
            }
            $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

            //ny times
            $articlesResponse =  $this->nyTimesArticlesRepo->getArticlesByCategory($category);
            if($articlesResponse["status"] == 'error')
            {
                $articlesResponse = [];
            }
            $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>$newsAPIArticles,
                'ny_times_articles'=>$nyTimesArticles,
            );
            return $data;
        }

        //user selects only source
        if(is_null($search) && !is_null($source) && is_null($category))
        {
            //get by search
            $newsAPIArticles = $this->newsApiArticlesRepo->getArticlesBySource($source);
            if($newsAPIArticles["status"] == 'error')
            {
                $newsAPIArticles = [];
            }
            $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

            //ny times
            $articlesResponse =  $this->nyTimesArticlesRepo->getArticlesBySource($source);
            if($articlesResponse["status"] == 'error')
            {
                $articlesResponse = [];
            }
            $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>$newsAPIArticles,
                'ny_times_articles'=>$nyTimesArticles,
            );
            return $data;
        }

        //user selects source and category
        if(is_null($search) && !is_null($source) && !is_null($category))
        {
            $newsAPIArticles = $this->newsApiArticlesRepo->getArticlesBySourceAndCategory($source,$category);
            if($newsAPIArticles["status"] == 'error')
            {
                $newsAPIArticles = [];
            }
            $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

            //ny times
            $articlesResponse =  $this->nyTimesArticlesRepo->getArticlesBySourceAndCategory($source,$category);
            if($articlesResponse["status"] == 'error')
            {
                $articlesResponse = [];
            }
            $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>$newsAPIArticles,
                'ny_times_articles'=>$nyTimesArticles,
            );
            return $data;
        }
    }

    public function getFeedsByPreference()
    {
        $user = User::getCurrentUser();
        $preferences = $this->feedPreferenceRepo->getPreferences($user->id);

        if(is_null($preferences)){
            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>[],
                'ny_times_articles'=>[],
            );
            return $data;
        }
        else{
            $newsAPIArticles = $this->newsApiArticlesRepo->getArticlesBySourceAndCategory($preferences->source,$preferences->category);
            if($newsAPIArticles["status"] == 'error')
            {
                $newsAPIArticles = [];
            }
            $newsAPIArticles =  $this->newsApiArticlesRepo->trimArticles($newsAPIArticles["data"]);

            //ny times
            $articlesResponse =  $this->nyTimesArticlesRepo->getArticlesBySourceAndCategory($preferences->source,$preferences->category);
            if($articlesResponse["status"] == 'error')
            {
                $articlesResponse = [];
            }
            $nyTimesArticles =$this->nyTimesArticlesRepo->trimArticles($articlesResponse["data"]);

            $data = array(
                'status'=>"ok",
                'user'=>array('id'=>User::getCurrentUser()->id,'name'=>User::getCurrentUser()->name),
                'news_api_articles'=>$newsAPIArticles,
                'ny_times_articles'=>$nyTimesArticles,
            );
            return $data;
        }
    }
}
