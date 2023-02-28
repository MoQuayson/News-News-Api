<?php


namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\IRegisterRepository;

class RegisterRepository implements IRegisterRepository{

    public function createUser($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->input('password'),
        ]);

        $user = User::where('email',$request->email)->first();
        $user->assignRole([Role::USERS]);

        return $user;
    }

    public function getAuthToken(User $user)
    {
        return $user->createToken('news aggregator api')->plainTextToken;
    }
}
