<?php


namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository{
    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }

    public function updateUser(User $user)
    {
        return User::where('id',$user->id)->update([
            'name'=>$user->name
        ]);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
