<?php

namespace App\Providers;

use App\Repositories\FeedsPreferenceRepository;
use App\Repositories\GuardiansArticlesRepository;
use App\Repositories\Interfaces\IFeedsPreferenceRepository;
use App\Repositories\Interfaces\ILoginRepository;
use App\Repositories\Interfaces\INewsFeedsRepository;
use App\Repositories\Interfaces\IRegisterRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\LoginRepository;
use App\Repositories\NewsFeedsRepository;
use App\Repositories\NYTimesArticlesRepository;
use App\Repositories\OpenNewsArticlesRepository;
use App\Repositories\RegisterRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ILoginRepository::class, LoginRepository::class);
        $this->app->bind(IFeedsPreferenceRepository::class, FeedsPreferenceRepository::class);
        $this->app->bind(INewsFeedsRepository::class, NewsFeedsRepository::class);
        $this->app->bind(IArticlesFetchRepository::class, OpenNewsArticlesRepository::class);
        $this->app->bind(IArticlesFetchRepository::class, NYTimesArticlesRepository::class);
        $this->app->bind(IArticlesFetchRepository::class, GuardiansArticlesRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IRegisterRepository::class, RegisterRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
