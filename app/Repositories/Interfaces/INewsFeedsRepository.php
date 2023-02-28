<?php

namespace App\Repositories\Interfaces;

interface INewsFeedsRepository{
    public function getFeeds();
    public function getFeedsBySearch($request);
    public function getFeedsByPreference();
}
