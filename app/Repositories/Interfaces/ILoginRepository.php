<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface ILoginRepository extends AuthRepositoryInterface {
    public function authenticateUser($user);
    public function updateLastLogin($email);

}
