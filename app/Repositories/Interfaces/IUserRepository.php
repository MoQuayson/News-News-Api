<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface IUserRepository{
    function getUserById($id);
    function updateUser(User $id);
    function getUserByEmail($email);
    //function getAllUsers();
}
