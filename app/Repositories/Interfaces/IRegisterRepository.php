<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface IRegisterRepository extends AuthRepositoryInterface{
    public function createUser($request);
}
