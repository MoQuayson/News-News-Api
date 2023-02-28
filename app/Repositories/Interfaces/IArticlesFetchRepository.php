<?php

namespace App\Repositories\Interfaces;

interface IArticlesFetchRepository{
    public function getArticles();
    public function trimArticles($articles);
    public function getArticlesByCategory($category);
    public function getArticlesBySearch($search);
    public function getArticlesBySearchAndSource($search,$source);
    public function getArticlesBySearchSourceAndCategory($search,$source,$category);
    public function getArticlesBySource($source);
    public function getArticlesBySourceAndCategory($source,$category);
}
