<?php


namespace App\Repositories\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface{
    public function getAuthToken(User $user);
}
